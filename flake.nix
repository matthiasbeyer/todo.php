{
  description = "todo.php";

  inputs = {
    nixpkgs.url = "nixpkgs/nixpkgs-unstable";
    flake-utils.url = "github:numtide/flake-utils";
    phps.url = "github:loophp/nix-shell";
  };

  outputs = { self, nixpkgs, flake-utils, phps } @ inputs:
    flake-utils.lib.eachDefaultSystem (system:
      let
        pkgs = import nixpkgs {
          inherit system;
        };

        psql_setup_file = pkgs.writeText "setup.sql" ''
          DO
          $do$
          BEGIN
            IF NOT EXISTS ( SELECT FROM pg_catalog.pg_roles WHERE rolname = 'todophp') THEN
              CREATE ROLE todophp CREATEDB LOGIN;
            END IF;
          END
          $do$
        '';

        postgres_setup = ''
          export PGDATA=$PWD/.state/postgres_data
          export PGHOST=$PWD/.state/postgres
          export LOG_PATH=$PWD/.state/postgres/LOG
          export PGDATABASE=postgres
          export DATABASE_CLEANER_ALLOW_REMOTE_DATABASE_URL=true

          if [ ! -d $PGHOST ]; then
            mkdir -p $PGHOST
          fi

          if [ ! -d $PGDATA ]; then
            echo 'Initializing postgresql database...'
            LC_ALL=C.utf8 initdb $PGDATA --auth=trust >/dev/null
          fi
        '';

        start_postgres = pkgs.writeShellScriptBin "start_postgres" ''
          pg_ctl start -l $LOG_PATH -o "-c listen_addresses= -c unix_socket_directories=$PGHOST"
          psql -f ${psql_setup_file} > /dev/null
        '';

        stop_postgres = pkgs.writeShellScriptBin "stop_postgres" ''
          pg_ctl -D $PGDATA stop
        '';
      in
      {
        devShells.default = pkgs.mkShell {
          buildInputs = [
            phps.packages."${system}".php81
            pkgs.postgresql_15
            pkgs.pgcli

            start_postgres
            stop_postgres
          ];

          shellHook = ''
            trap "bash ${stop_postgres}/bin/stop_postgres" EXIT
            ${postgres_setup}

            bash ${start_postgres}/bin/start_postgres
          '';
        };
      }
    );
}

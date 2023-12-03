{ pkgs }: {
	deps = [
		pkgs.sqlite.bin
  pkgs.nodejs-16_x
  pkgs.php80
        pkgs.php80Packages.composer
	];
}
#GIT
https://github.com/salexanderpc/tesisImg.git

#GIT Clone
Clone to localhost folder: git clone https://github.com/user/project.git ~/dir/folder
Clone specific branch to localhost: git clone -b branchname https://github.com/user/project.git
######## git clone ssh://git@github.com:salexanderpc/shark/tesisImg.git /var/www

#Cerrar aplicaciones en kde
Alt+F2 --> ksysguard

#cambiar nombre a carpeta
mv original final

#Dump de BD en Postgresql
pg_dump baseName > ruta/subRuta/archivo.sql

#Cargar BD
psql -U usuario -d baseName -f ruta/archivo_backup.sql

#assets web
php app/console assets:install

#limpiar cache en app
php app/console cache:clear
php app/console cache:clear --env=dev --no-warmup
php app/console cache:clear --env=prod

#host virtual

#informacion de hardware de pc
cat /proc/meminfo
cat /proc/cpuinfo

#listar disp. PCI
lspci

#USB
lsusb

#Tamaño de las BD en Postgresql
SELECT pg_database.datname, pg_size_pretty(pg_database_size(pg_database.datname)) AS SIZE FROM pg_database;

#Symfony
http://juandarodriguez.es/.~~cursosf20~~/unidad1.html

#Instalación y configuración Postgresql
https://lcaballero.wordpress.com/2013/03/01/instalacion-de-postgresql-en-debian-gnulinux-wheezy/

#Conexiones remotas postgresql
psql -h 192.168.1.114 -U simagd -d simagdSanRafa
http://frikinice.blogspot.com/2012/05/como-hacer-una-conexion-remota-con.html
http://www.forosdelweb.com/f99/conexion-remota-pgadmin-postgress-1104313/

#Formatear usb debian
http://blog.desdelinux.net/con-el-terminal-formatear-una-memoria-usb/
http://es.kioskea.net/contents/610-fat16-y-fat32

#Montar y desmontar usb
http://techfico.blogspot.com/2010/03/montar-y-desmontar-memoria-usb.html


#Instalar Evolus Pencil
aptitude update
wget https://evoluspencil.googlecode.com/files/evoluspencil_2.0.5_all.deb
dpkg-deb -x evoluspencil_2.0.5_all.deb dir_tmp
dpkg-deb --control evoluspencil_2.0.5_all.deb dir_tmp/DEBIAN
nano dir_tmp/DEBIAN/control
dpkg -b dir_tmp evoluspencil_2.0.5_all.deb
sudo dpkg -i evoluspencil_2.0.5_all.deb


#import mapeo ORM
php app/console doctrine:mapping:convert xml ./src/Minsal/SimagdBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="ImgCtlEstadoCita"
php app/console doctrine:mapping:import MinsalSimagdBundle annotation --filter="ImgCtlEstadoCita"
php app/console doctrine:generate:entities MinsalSimagdBundle:ImgCtlEstadoCita --no-backup


#Tamaño de particiones
df -h

#buscar en recursivo
find . -name "*.bak" -type f

#borrar en recursivo
find . -name "*.bak" -type f -delete

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
php app/console assets:install --symlink --env=prod

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

#git ignore
http://digitizor.com/gitignore-not-ignoring-files-how-to-fix/

#listar dispositivos
sudo fdisk -l


#gitignore untracked files
git rm -r --cached .
git add .
git commit -m "fixed untracked files"


#extract db1.table to other db2.table
pg_dump -t table_to_copy source_db | psql target_db

pg_dump -a -t my_table my_db | psql target_db

pg_dump -a -t img_ctl_tipo_mamografia minsalsiaps | psql simagdigital

#last commit
git show --name-status

#show counts of commits
git log --shortstat
git log --author=shark --shortstat

#search text pattern in files
grep -rnw '/path/to/somewhere/' -e "pattern"

#trim all white spaces type postgresql
regexp_replace(conexion, '^\s+', '') as conexion

update test1 set name = replace(name, '$', '');



pg_dump --inserts -t img_ctl_campo_autocomplementar simagdigital > ../simagdigital/backup_sql/NEW_XRAY_TABLES/NEWRXTABLE.sql
psql -U simagd -d simagdigital -f ../simagdigital/backup_sql/NEW_XRAY_TABLES/img_ctl_tipo_respuesta_radiologica.sql


#git repository with existing project
https://www.adictosaltrabajo.com/tutoriales/github-first-steps-upload-project/


######### reset git config
git filter-branch --index-filter 'git rm -r --cached --ignore-unmatch app/logs/dev.log'

git config --global user.name "Farid Hernández"
git config --global user.email "farid.hdz.64@gmail.com"

git config --global color.status auto
git config --global color.branch auto
git config --global color.diff auto
git config --global color.interactive auto
git init
git diff --cached
git commit -a
git add *
git commit -m 'Subo la estructura del proyecto al repositorio de GitHub'
git push -u origin shark

cat .git/config


######### unzip multiple
unzip '*.zip'

######### unzip in folder
unzip package.zip -d /opt
MY_PLUGINS$        unzip '*.zip' -d /home/farid/NetBeansProjects/versionsharksimagdigital/src/Minsal/SimagdBundle/Resources/public/plugin/

######### remove except
rm !(file.txt)


######### git pull | push
git branch
git add --all
git commit -am 'commit plugins'
git push origin shark
git pull origin shark



######### symfony steps
rm -rf app/cache/*
rm -rf app/logs/*
exit
setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
php app/console assets:install


######### git logs
git log --stat


######### cache clear
php app/console cache:clear --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug

######### for assetic
php app/console cache:clear --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug
php app/console assets:install


######### clone project
https://github.com/salexanderpc/tesisImg.git


######### usual configuration
rm -rf app/cache/*
rm -rf app/logs/*

exit

setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs

php app/console cache:clear --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug
php app/console assets:install

######### upgrade
sudo apt-get dist-upgrade

######### store credentials
git config credential.helper store


######### git exclude files
git add -u
git reset -- main/dontcheckmein.txt
git reset -- main/*


######### command in sigereq
php app/console doctrine:mapping:convert xml ./src/SanRafael/RequerimientosBundle/Resources/config/doctrine/metadata/orm --from-database --force
php app/console doctrine:mapping:import SanRafaelRequerimientosBundle annotation
rm src/SanRafael/RequerimientosBundle/Entity/FosUser*
rm src/SanRafael/RequerimientosBundle/Resources/config/doctrine/metadata/orm/FosUser*

######### command in sigereq no override
php app/console doctrine:mapping:convert xml ./src/SanRafael/RequerimientosBundle/Resources/config/doctrine/metadata/orm --from-database --force
rm src/SanRafael/RequerimientosBundle/Resources/config/doctrine/metadata/orm/FosUser*
php app/console doctrine:generate:entities SanRafaelRequerimientosBundle --no-backup

git branch
git add --all
git commit -am 'commit plugins'
git push origin farid
git pull origin farid


######### helper store
git config --global credential.helper 'cache --timeout 7200'
git config credential.helper store


######### merge conflicts
git diff --name-only --diff-filter=U


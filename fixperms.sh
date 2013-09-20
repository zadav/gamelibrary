s script is used to fix the system permissions. execute it every after svn:up
#You must keep this script up to date (new component=new system user=new lines in this script)

. scriptparameters

echo Fix some rights on project subtree

echo Chown folders to the project user

chown -R $PROJECTUSER.$APACHEGROUP "src/"

chmod -R a-rwx "src/"

chmod -R u+rwX "src/"
chmod -R a+rX "src/"

echo Fix Apache writable directories

for i in $ApacheWritableDirs
do
  chgrp -R $APACHEGROUP $i
  chmod -R g+rwX $i
done

echo Fix Executables files

for i in $ExecutableFiles
do
  chmod +x $i
done


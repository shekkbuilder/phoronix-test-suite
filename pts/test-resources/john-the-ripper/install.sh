#!/bin/sh

tar -xvf john-1.7.3.1.tar.gz
cd john-1.7.3.1/src/

case $OS_TYPE in
	"MacOSX" )
		make macosx-x86-64
	;;
	"Solaris" )
		make solaris-x86-64-cc
	;;
	"BSD" )
		make freebsd-x86-64
	;;
	* )
		if [ $OS_ARCH = "x86_64" ]
		then
			make linux-x86-64
		else
			make linux-x86-sse2
		fi
	;;
esac

cd ../../

echo "#!/bin/sh
cd john-1.7.3.1/run/
./john --test > \$LOG_FILE 2>&1
echo \$? > ~/test-exit-status" > john-the-ripper
chmod +x john-the-ripper
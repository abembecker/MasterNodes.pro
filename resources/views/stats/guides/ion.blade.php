@include('stats.guides.NOGUIDES')
<div class="row">
    <div></div>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        {{--<div class="panel panel-default">--}}
        {{--<div class="panel-body">A Basic Panel</div>--}}
        {{--</div>--}}
        <h3>Linux QT Builder</h3>
        <textarea id="linuxQTbuilder">
# Update repository
sudo apt-get update

# Upgrade
sudo apt-get dist-upgrade -y

# Cleanup
sudo apt-get autoclean
sudo apt-get autoremove

# Update all packages
sudo apt-get update
sudo apt-get upgrade -y

# Cleanup
sudo apt-get autoclean
sudo apt-get autoremove

# Install git
sudo apt-get install git

# Install Build requirements
sudo apt-get install build-essential libtool autotools-dev automake pkg-config libssl-dev libevent-dev bsdmainutils

# Install boost, openssl, BerkeleyDB, libminiupnpc-dev, libzmq3-dev, libqrencode-dev packages
# You can install boost or compile directly from source, I excluded libboost packages here as we will build with depends folder
# sudo apt-get install libboost-all-dev libminiupnpc-dev libzmq3-dev libqrencode-dev

# Install QT5
sudo apt-get install libqt5gui5 libqt5core5a libqt5dbus5 qttools5-dev qttools5-dev-tools libprotobuf-dev protobuf-compiler

# Download ION sources (downloading only master branch)
#   download with HTTPS
git clone https://github.com/cevap/ion.git -b master --depth=1;
#   download with SSH
# git clone git@github.com:cevap/ion.git -b master --depth=1;

# Go to downloaded ion dir
cd ./ion

# Build all dependencies
cd depends # go to depends dir
make HOST=x86_64-pc-linux-gnu # build for cross compilation
cd .. #go back to ion root folder
# Common host-platform-triplets for cross compilation are:
#    i686-w64-mingw32 for Win32
#    x86_64-w64-mingw32 for Win64
#    x86_64-apple-darwin11 for MacOSX
#    arm-linux-gnueabihf for Linux ARM 32 bit
#    aarch64-linux-gnu for Linux ARM 64 bit

# Build and compile ion-qt and iond
./autogen.sh
./configure --prefix=`pwd`/depends/x86_64-pc-linux-gnu
make HOST=x86_64-pc-linux-gnu
sudo make install

# create datadir
mkdir ~./ioncoin
cd ~./ioncoin
wget https://github.com/cevap/ion/releases/download/v2.1.6.2/bootstrap.dat
wget https://raw.githubusercontent.com/cevap/ion/master/contrib/debian/examples/ioncoin.conf

# launch ion-qt
ion-qt
        </textarea>
    </div>
    <div class="col-md-2"></div>
</div>
<script>
    $(document).ready(function () {
        var editor = CodeMirror.fromTextArea($('#linuxQTbuilder')[0], {
            lineNumbers: true
        });
    });
</script>
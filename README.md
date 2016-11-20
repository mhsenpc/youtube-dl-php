# youtube-dl-php
youtube-dl-php - download videos from youtube.com or other video platforms by a php interface

# installation
1- Just copy theese files to your web server
2- chmod 777 csrf.txt

# other programs
- Youtube-dl
- Bootstrap
- jquery

# create size limited partition for files directory
  dd if=/dev/zero of=/tmp/files.img bs=1024 count=10000
  mke2fs /files.img
  mount /files.img /mnt/files -o loop=/dev/loop0
  
p.s: to make it permanent you should write this in fstab

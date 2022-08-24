#!/bin/bash
for f in *.JPG;
    do ffmpeg -i "$f" -q:v 5   -y "${f%.JPG}.JPG"; 
done


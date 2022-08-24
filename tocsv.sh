#!/bin/bash

for i in *.xlsm; do libreoffice --headless --convert-to csv "$i" ; done


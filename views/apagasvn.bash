#!/bin/bash
# Autor: Renan Susuki
# E-mail: renan.susuki@gmail.com
# Script que converte arquivos .tif para .pdf a partir de um diretorio base, e que pode haver outros sub-diretorios.
# E necessario que tenha instalado o programa tiff2pdf. No meu caso instalei no ubuntu 10.10 com o seguinte comando:
# sudo apt-get install libtiff-tools
 
avi=".avi"
local=$(pwd)                 #$local recebe o diretorio base
ls -RaF |grep : |tr : / > /home/familia/Documentos/todosDiretorios.txt   #lista recursivamente, depois filtra so os diretorios e manda para o arquivo arvore.txt, substitui : por /
vardir=$(cat /home/familia/Documentos/todosDiretorios.txt) #$vardir guarda o conteudo de arvore.txt
for x in $vardir; do      
      cd $x  
      dir_atual=$(pwd)
      echo "-----------Abrindo o diretorio: $dir_atual"
      ls -a  | while read arquivo #lista todas os arquivos tif do diretorio corrente
      do           
         if [ -d $arquivo ]
         then
      #Caso for um diretorio nao faz nada
	  if [$arquivo eq '.svn'] 
	    then
	      rm -rf $arquivo
	  fi
      done  
   cd $local    
done  
 
#apagando a lista dos diretorios usado
rm -f /home/familia/Documentos/todosDiretorios.txt

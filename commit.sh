clear

echo -e "---------\n----------Starting Commit in Following Branch-------------------------";


commit=$1;

currBranch=$(git branch | grep '* ');
currBranch=${currBranch:2};

availBranch=$(git branch);

echo -e " \n You are currently on Branch : \e[31m\e[1m$currBranch \e[0m";

echo -e "\n Available Branches  : \n $availBranch";

continued="y";

while [ "$continued" = "y" ]

do 

	echo -e "\n you are going to use following commit : $commit"

	read -p "To which branch you want to commit : " commitToBranch;

	echo -e "\n -------------------Fetching Latest Code -------------------------";
	git checkout $commitToBranch;

	git pull;

	echo -e "\n -------------------Fetching Done -------------------------";

	read -p "Please confirm you want to continue with commit (y/n) : " confirmation;


	if [ "$confirmation" = "y" ]; 
	then

		#git cherry-pick $commit;

		#git push origin $commitToBranch;

		echo -e "\n \e[42m\e[1m Applying commi \e[0mt";
	else
		echo -e "\n  \e[31m\e[1m Aborting action \e[0m";
	fi



	git checkout $currBranch;

	read -p "Do you want to continue (y/n) : " continued;

done

echo -e "\n\n Thank You\n";

A Bash Script For GIT
====

This is an bash script for replicating excat similler commits to the other braches.

It will handle the headache of swtiching to new branch, fetching the latest changes, then replicate changes then again push back to that branch.

all above is just command away.

Steps :
let's say you are on the develop branch you already had and commit to that branch. and now you want the same change to the support branch then. 
firstly fetch the hash of already done commit in the develop branch. you can easily see the hash using following command of git.

git log

now, copy the hash of the commit. and run the following command.

bash commit.sh GIT_COMMIT_HASH

Read the instruction carefully showing up after running this command.

Thank You


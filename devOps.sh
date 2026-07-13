#! /bin/bash

# Function that creates the following directories when the Lead Directory is provider
# 1. app/Domain/{DomainName}/Http/Controllers
# 2. app/Domain/{DomainName}/Http/Requests
# 6. app/Domain/{DomainName}/Contracts
# 7. app/Domain/{DomainName}/Repositories
# 8. app/Domain/{DomainName}/Services

# Ask for the domain name
echo "Enter the domain name:"
read domainName

# exit if the directory already exists
if [ -d "app/Domain/$domainName" ]; then
    echo "Directory already exists"
    exit 1
fi

# Create the directories
mkdir -p app/Domain/$domainName/Http/Controllers
mkdir -p app/Domain/$domainName/Http/Requests
mkdir -p app/Domain/$domainName/Contracts
mkdir -p app/Domain/$domainName/Repositories
mkdir -p app/Domain/$domainName/Services
mkdir -p app/Domain/$domainName/Models


# Create the files
# touch app/Domain/$domainName/Http/Controllers/{$domainName}Controller.php
# touch app/Domain/$domainName/Http/Requests/$domainNameRequest.php
# touch app/Domain/$domainName/Contracts/$domainNameContract.php
# touch app/Domain/$domainName/Repositories/$domainNameRepository.php
# touch app/Domain/$domainName/Services/$domainNameService.php

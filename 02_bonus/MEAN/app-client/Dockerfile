FROM node:12.7

# Create the folder where our application will be located
RUN mkdir -p /var/www/app

# Select the directory where your commands will run
WORKDIR /var/www/app

# Copy our package.json file to the working directory
COPY package.json /var/www/app

# Set up dependencies
RUN npm install

# Copy all project files to docker image
COPY . /var/www/app

# The port on which the application will run
EXPOSE 4200

# Run the command to stand up the project
CMD ["npm", "start"]
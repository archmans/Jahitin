# FROM node:20-alpine as builder

# WORKDIR /rest-jahitin

# COPY package*.json .
# COPY .env .
# COPY package-lock.json .
# COPY package.json .

# RUN npm install
# COPY . .
# CMD ["npm", "run", "dev"]

# Use an official Node.js runtime as a parent image
FROM node:20-alpine

# Set the working directory to /rest-jahitin
WORKDIR /rest-jahitin

# Copy package.json and package-lock.json to the working directory
COPY package*.json ./

# Install app dependencies
RUN npm install

# Copy the current directory contents into the container at /rest-jahitin
COPY . .

COPY .env .

# Make port 4000 available to the world outside this container
EXPOSE 4000


# Run app.js when the container launches
CMD ["npm", "run", "dev"]

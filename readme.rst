
###################
User
###################
EMAIL: akbar@gmail.com
PASSWORD: 123

###################
Endpoint
###################

a. Login
POST: index.php/AuthController/Login
PARAMS: EMAIL, PASSWORD

b. Master User

Get All
GET: /index.php/MasterUserController/getAll

Get By Id
GET: /index.php/MasterUserController/getById/{id}

Create
POST: /index.php/MasterUserController/create
PARAMS: EMAIL, PASSWORD, FULL_NAME

Update
POST: /index.php/MasterUserController/update
PARAMS: ID, EMAIL, PASSWORD, FULL_NAME

Delete
POST: /index.php/MasterUserController/delete
PARAMS: ID

c. Getting Data Realtime

GET: /index.php/GettingData/getDataByName
PARAMS: NAME

GET: /index.php/GettingData/getDataByNIM
PARAMS: NIM

GET: /index.php/GettingData/getDataByYMD
PARAMS: YMD
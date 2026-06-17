# AquaFin Project 💧
## Description :

Aquafin is a platform that allows users to consult material and monitor flood risks.
The application combines Laravel with a Python forecasting service to predict rainfall for the coming year.

## Features / Pages :
### Dashboard 
Main overview page after login
Functions:
- Reminder for the gas detection meter
- Shows recommended materials based on rainfall/weather data
- Recommended materials can be directly added to the shopping cart with one button
- Displays rainfall overview in a table
- Shows rainfall data per province using a diagram

### Materials 
Overview of available materials
Functions:
- Displays the complete material list
- Search bar to find materials
- Category filter button
- Add materials to shopping cart
- Request custom material button

Admin functions:
- Add new materials
- Edit existing materials
- Delete materials

### Rainfall Overview 
Visualize rainfall predictions.
Functions:
- Displays a 1-year rainfall forecast
- Shows rainfall data in a line chart
- Forecast data is generated through Python forecasting 

Note:
After login, users are redirected here first because the rainfall forecast must be activated before recommendations can be displayed on the dashboard.

### Contact 
Communication between users and administrators
Functions:
- Create a new contact form
- View sent forms
- View received forms

### Profile
Manage user information.
Functions:
- Displays user details
- Allows updating profile information and password

### Shopping Cart
Manage selected materials
Functions:
- View selected materials
- Remove materials
- Update quantity of materials
- Shows delivery time

### Admin Orders
Manage orders
Admin functions:
- View placed orders
- Manage order status by accepting or refusing

 ### Admin Flood Material page 💧 :
Admins can add/remove materials that will be suggested in the dashboard page if the amount of rain is over the threshold of the season.
Threshold per season mm of rainfall during that whole season:
winter => 300
spring => 250
summer => 260
autumn => 280

The rainfall data is collected from the Python API that is ran locally.

## Requirements:

- Larvel Herd must be set up.

- Python must be installed.

## Installation guide 🔧 :

Any text like this must be pasted in the command prompt (CMD) `example text to show the tags`

Open CMD and paste in the following commands: 

 ### Copying the Aquafin Project:

- `git clone https://github.com/friendlyBrandon/AquaFin_Project.git`

## Setting up the website:

- `cd AquaFin_Project`

- `composer install`

- `copy env.example .env`

- `php artisan key:generate`

- `php artisan migrate:fresh --seed`

- `npm install`

- `npm run build`

## Forcasting python 1 year 🌧️:

### Windows :

- Go to the forcasting folder in the main folder of the project.

- Go into the forcasting folder by `cd forcasting`

- Create venv enviroment by `python -m venv venv` (must be only done the first time, the enviroment is generated this step can be skipped)

- Activate venv by typing `venv\Scripts\activate.bat`

- Install needing dependencies `pip install prophet pandas flask` (must be done only the first time in the virtual enviroment of venv, afterwards this step can be skipped)

- Start Python script `python forcast.py`

### Linux Debian based 🐧:

- Go to the forcasting folder in the main folder of the project.

- Go into the forcasting folder by `cd forcasting`

- Create venv enviroment by `python -m venv venv` (must be only done the first time, the enviroment is generated this step can be skipped)

- Activate venv by typing `source venv/bin/activate`

- Install needing dependencies `pip install prophet pandas flask` (must be done only the first time in the virtual enviroment of venv, afterwards this step can be skipped)

- Start Python script `python forcast.py`

  

## Sources 🔗 :

- https://chatgpt.com/share/6a2557ea-2c10-83eb-a11b-fefca377a8e7

- https://chatgpt.com/share/6a26c044-1f34-83ed-a0b1-16334c2f3d85

- https://chatgpt.com/share/6a281b15-9320-83ed-988e-41776d3d17ae

- https://chatgpt.com/c/6a32566a-6f14-83ed-b6b6-b81b902612b9

- https://medium.com/@barisenzeybek/time-series-analysis-and-forecasting-with-metas-prophet-library-d44e2e911b03


## API data source on dashboard 🔗 :

- https://open-meteo.com/en/docs (weather)

- https://open-meteo.com/en/docs/geocoding-api (location for city)


## API data Python bot :
This bot is made with the Phrophet library of Meta.

 ### Links for the Meta Prophet library :

 - https://medium.com/@barisenzeybek/time-series-analysis-and-forecasting-with-metas-prophet-library-d44e2e911b03  

 - https://ai.meta.com/blog/neuralprophet-the-neural-evolution-of-facebooks-prophet/
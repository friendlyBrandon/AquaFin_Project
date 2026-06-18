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

- https://gemini.google.com/share/3bcde1a9de0f

- https://gemini.google.com/share/7b6f112e7114

- https://gemini.google.com/share/7b7f9c315072

- https://gemini.google.com/share/5267665b6a79

- https://gemini.google.com/share/2689f65e9098



## API data source on dashboard 🔗 :

- https://open-meteo.com/en/docs (weather)

- https://open-meteo.com/en/docs/geocoding-api (location for city)



## API data Python bot :
This bot is made with the Phrophet library of Meta.

 ### Links for the Meta Prophet library :

 - https://medium.com/@barisenzeybek/time-series-analysis-and-forecasting-with-metas-prophet-library-d44e2e911b03  

 - https://ai.meta.com/blog/neuralprophet-the-neural-evolution-of-facebooks-prophet/



# Screenshots of the website :

 - Welcome page:
<img width="1916" height="913" alt="image" src="https://github.com/user-attachments/assets/8e34aebd-11ae-40af-bd2c-b69199ce8c44" />


<!-- -->
 - Register page:
<img width="1912" height="913" alt="image" src="https://github.com/user-attachments/assets/a1434b31-c0ee-4ce9-a04e-7fa753813ecc" />


<!-- -->
 - Login page:
<img width="1919" height="914" alt="image" src="https://github.com/user-attachments/assets/c8dd391b-b581-4b8b-aae4-e3bdf1143a80" />


<!-- -->
 - Reset password page:
<img width="1917" height="916" alt="image" src="https://github.com/user-attachments/assets/525d9d40-9fbd-4620-a1f7-f8cc42191690" />


<!-- -->
 - Dashboard:
<img width="1899" height="910" alt="image" src="https://github.com/user-attachments/assets/38dda295-f092-43f1-b53e-7d88e018b1cf" />


<!-- -->
 - Material page to order the materials you need:
<img width="1896" height="913" alt="image" src="https://github.com/user-attachments/assets/3dade60c-d426-45ef-b334-c52ecb552a34" />


<!-- -->
 - Rainforecast page for a year:
<img width="1915" height="916" alt="image" src="https://github.com/user-attachments/assets/0a0ee882-6b36-4632-808f-b60dbf833a1e" />


<!-- -->
 - Contact page, own function can be "technieker", "admin" or "stockmedewerker":
<img width="1911" height="913" alt="image" src="https://github.com/user-attachments/assets/fc75f05a-a453-493c-ac24-2e23d99fd4f1" />
<img width="1909" height="912" alt="image" src="https://github.com/user-attachments/assets/99e229f1-3335-4cbc-9df6-98e7e0a274a6" />
<img width="1909" height="918" alt="image" src="https://github.com/user-attachments/assets/17b630c4-8beb-47f3-a627-9fdd3bf39d32" />
<img width="1913" height="913" alt="image" src="https://github.com/user-attachments/assets/266be13c-2d44-4e49-9b29-0a9a683779ec" />


<!-- -->
 - Profile page to edit province info and your password:
<img width="1899" height="911" alt="image" src="https://github.com/user-attachments/assets/618d27eb-3201-401d-8b3a-65d5fe2c10dc" />


<!-- -->
 - Cart page to view what you wish to order after you already added it to your cart:
<img width="1899" height="917" alt="image" src="https://github.com/user-attachments/assets/abbf3134-dbe9-4a76-8511-ceef8e029633" />


<!-- -->
 - Orderlog page for "admins" and "stockmedewerkers":
<img width="1908" height="922" alt="image" src="https://github.com/user-attachments/assets/23a5fea0-9010-4e46-b6af-b421e4d3274f" />


<!-- -->
 - If the rainfall during a season is over the treshold and you have viewed the rainforecast page every season you will see suggested materials on the dashboard page:
<img width="1905" height="913" alt="image" src="https://github.com/user-attachments/assets/4b111404-ea12-4003-a2d0-b1512fe45ced" />


<!-- -->
 - The Materials you get if you get the suggested materials:
<img width="1893" height="916" alt="image" src="https://github.com/user-attachments/assets/265c0810-4852-475e-b011-a6de6fc42cae" />


<!-- -->
 - Suggested materials can be changed by admins:
<img width="1899" height="918" alt="image" src="https://github.com/user-attachments/assets/aef55374-5831-41fa-97e4-e534c2036c60" />

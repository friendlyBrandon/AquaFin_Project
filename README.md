# Requirements:

- Larvel Herd must be set up.

- Python must be installed.

# Installation guide 🔧 :

Any text like this must be pasted in the command prompt (CMD) `example text to show the tags`

Open CMD and paste in the following commands: 

 ## Copying the Aquafin Project:

- `git clone https://github.com/friendlyBrandon/AquaFin_Project.git`

# Setting up the website:

- `cd AquaFin_Project`

- `composer install`

- `copy env.example .env`

- `php artisan key:generate`

- `php artisan migrate:fresh --seed`

- `npm install`

- `npm run build`

# Forcasting python 1 year 🌧️:

## Windows :

- Go to the forcasting folder in the main folder of the project.

- Go into the forcasting folder by `cd forcasting`

- Create venv enviroment by `python -m venv venv` (must be only done the first time, the enviroment is generated this step can be skipped)

- Activate venv by typing `venv\Scripts\activate.bat`

- Install needing dependencies `pip install prophet pandas flask` (must be done only the first time in the virtual enviroment of venv, afterwards this step can be skipped)

- Start Python script `python forcast.py`

## Linux Debian based 🐧:

- Go to the forcasting folder in the main folder of the project.

- Go into the forcasting folder by `cd forcasting`

- Create venv enviroment by `python -m venv venv` (must be only done the first time, the enviroment is generated this step can be skipped)

- Activate venv by typing `source venv/bin/activate`

- Install needing dependencies `pip install prophet pandas flask` (must be done only the first time in the virtual enviroment of venv, afterwards this step can be skipped)

- Start Python script `python forcast.py`

  

# Sources 🔗 :

- https://chatgpt.com/share/6a2557ea-2c10-83eb-a11b-fefca377a8e7

- https://chatgpt.com/share/6a26c044-1f34-83ed-a0b1-16334c2f3d85

- https://chatgpt.com/share/6a281b15-9320-83ed-988e-41776d3d17ae


# API data source on dashboard 🔗 :

- https://open-meteo.com/en/docs (weather)

- https://open-meteo.com/en/docs/geocoding-api (location for city)

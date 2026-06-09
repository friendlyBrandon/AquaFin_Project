import json
import pandas as pd
import prophet
import numpy as np

def run_prophet_forecast(json_data_string):
    try:
        # 1. Data ontvangen en structureren
        data = json.loads(json_data_string)
        
        # 2. DataFrame maken
        df = pd.DataFrame(data)
        df['ds'] = pd.to_datetime(df['Date']) # Converteert de jaartallen naar datums
        df['y'] = df['Rainfall']
        
        # 3. Het Prophet Model Trainen
        model = prophet.Prophet(
            yearly_seasonality=True,  # Cruciaal: er is een seizoenscyclus van 12 maanden.
            weekly_seasonality=False, 
            daily_seasonality=False
        )
        model.fit(df)
        
        # 4. De Toekomstige Dataframe Creëren (5 jaar = 60 maanden)
        future_periods_months = 12 # 60 maanden
        # We gebruiken 'MS' (Month Start) als frequentie
        future = model.make_future_dataframe(periods=future_periods_months, freq='MS') 
        
        # 5. Voorspellen
        forecast = model.predict(future)
        
        # 6. Resultaten Filteren en Formatteren
        
        # De voorspellingen van de laatste 60 maanden (5 jaar)
        future_data = forecast[['ds', 'yhat']].tail(12)
        
        # 7. Aggregatie en Structurering voor PHP
        results = []
        
        # We moeten de 60 voorspelde rijen verwerken om ze per maand/jaar te groeperen.
        
        # De data is al perfect op maandbasis, we hoeven niet meer te middelen, 
        # we nemen gewoon de voorspelde waarde 'yhat'.
        
        # We itereren over de 60 toekomstige data points
        for i, row in future_data.iterrows():
            date_obj = row['ds'].date()
            year = date_obj.year
            month = date_obj.month
            rainfall = row['yhat']
            
            # We voegen de data toe in de structuur die PHP verwacht: een platte lijst.
            results.append({
                'year': year,
                'month': month,
                'rainfall': round(rainfall, 2)
            })
            
        return json.dumps(results)

    except Exception as e:
        return json.dumps({'error': str(e)})

from flask import Flask, request

app = Flask(__name__)

@app.route('/api/forecast', methods=['POST'])
def forecast():
    json_data = request.json['data']
    return run_prophet_forecast(json_data)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=6942)
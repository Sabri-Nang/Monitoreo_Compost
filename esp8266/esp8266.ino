#include <ESP8266WiFi.h>
#include <WiFiManager.h>
#include <strings_en.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

/* Librerias para los sensores*/
//#include <DHT.h>
//#define DHTTYPE DHT11
#include <OneWire.h>
#include<DallasTemperature.h>


/* Pines */
#define DS18B20 D1 //pin sensor ds18b20


/* servidor */
String  serverName = "http://192.168.0.10/proyecto_final_iot/recibir.php";


/*Datos a enviar */
String dispositivo = "node1";
float temp;
int humedad;
/*Datos a recibir*/
int bomba;

//DHT dht(pin, DHTTYPE);
OneWire ourWire(DS18B20);
DallasTemperature sensor(&ourWire);





void setup() {

  WiFi.mode(WIFI_STA);
  Serial.begin(115200);  
  Serial.println("Activando el sensor...");
  sensor.begin(); //Inicializo el sensor de Temperatura
  
  
  //WiFiManager, Local intialization. Once its business is done, there is no need to keep it around
  WiFiManager wm;
  bool res;
  res = wm.autoConnect("AutoConnectAP", "password");

  if(!res){
    Serial.println("Failed to connect");
  }
  else{
    Serial.println("Conectado...");
  }
  



}

void loop() {
  
  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  HTTPClient http;
  http.begin(client, serverName);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  

  //Leo la temperatura
  //temp = dht.readTemperature();
  //humedad = dht.readHumidity();
  sensor.requestTemperatures(); //Le pide el valor de temperatura al sensor
  temp = sensor.getTempCByIndex(0); //Lee el valor de temperatura del sensor
  humedad = 50;
  //bomba = 0;

  Serial.print("La temperatura es: ");
  Serial.println(temp);
  Serial.print("La humedad es: ");
  Serial.println(humedad);

  String postData = "dispositivo="+dispositivo+"&temperatura="+String(temp)+"&humedad="+String(humedad)+"&bomba="+String(bomba); 
  int httpCode = http.POST(postData);
  String respuesta = http.getString();

  Serial.println("RESPUESTA DEL SERVIDOR");
  Serial.println(httpCode);
  Serial.println(respuesta);

  Serial.println("---------------------------");

  int ini = respuesta.indexOf(":");
  int fin = respuesta.indexOf("}", ini);
  bomba = respuesta.substring(ini+1, fin).toInt();
  //delay(500);

  //Termino la comunicacion
  http.end();
  Serial.println("VALORES GUARDADOS EN LAS VARIABLES");
  Serial.print("variable bomba: ");
  Serial.println(bomba);
  Serial.println("-------------------------------");
  
  
  delay(10000);

  //Serial.println();
  //Serial.println("closing connection");
  }

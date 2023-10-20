#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

// Reemplazar con los datos de tu red wifi
const char* ssid = "JAJAJA";
const char* password = "";


const int buzzer = 15;// Pin para el buzzer
String mensaje = "";
const int firePin = 16;//pin para el sensor de fuego
const int gasPin = A0;//Pin para el sensor de gas
int gasValor = 0;
int fireValor = 0;

const String url = "http://192.168.0.17/deteccion-incendios/info-sensores.php";
const String correo = "franklin9perez952012@gmail.com";

//variables para verificar fuga y fuego
int fugaGas = 0; // 0 indica que no hay fuga
int fuegoDetectado = 0; // 0 indica que no hay fuego

////Setup////
void setup() {
  delay(5000);
  Serial.begin(115200);
  pinMode(buzzer, OUTPUT);//El pin del buzzer como salida
  // Intenta conectarse a la red Wifi:
  Serial.print("Conectando a la red wifi... ");
  Serial.println(ssid);
  //Seteo de la red Wifi
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  Serial.println("");
  Serial.println("Conectado a la red wifi!!!");
  Serial.print("Dirección ip: ");
  Serial.println(WiFi.localIP());//Imprimimos la direción ip local
  
}
/////loop//////
void loop() {
   delay(2000);

     Serial.println("Sistema preparado!");
   //Lectura de los sensores
     fireValor = digitalRead(firePin);
     gasValor = analogRead(gasPin);
  Serial.print("Sensor fuego: ");
  Serial.println(fireValor);  //Envío del valor al puerto serie
  Serial.print("Sensor gas: ");
  Serial.println(gasValor);  //Envío del valor al puerto serie

  if(fireValor == 1){
    Serial.println("Fuego detectado!");
    mensaje = "Se ha detectado fuego";//Mensaje
    fuegoDetectado = 1;
    digitalWrite(buzzer, HIGH);
    delay(2000);
    digitalWrite(buzzer, LOW); 
  }

    if(gasValor >= 800){
    Serial.println("Escape de gas detectado!");
    mensaje = "Escape de gas detectado!";//Mensaje
    fugaGas = 1;
    digitalWrite(buzzer, HIGH);
    delay(50);
    digitalWrite(buzzer, LOW);
    delay(50);
    digitalWrite(buzzer, HIGH);
    delay(50);
    digitalWrite(buzzer, LOW); 
    delay(50);
    digitalWrite(buzzer, HIGH);
    delay(50);
    digitalWrite(buzzer, LOW);
    delay(50);
    digitalWrite(buzzer, HIGH);
    delay(50);
    digitalWrite(buzzer, LOW); 
    }

   if(WiFi.status()== WL_CONNECTED){   //Check WiFi connection status
    WiFiClient client;
    HTTPClient http;
    if(fugaGas==1){
      
    String datos_a_enviar = "alarma_gas=fuga de gas detectada&correo="+correo;

    http.begin(client, url);        //Indicamos el destino
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.
    int codigo_respuesta = http.POST(datos_a_enviar);   //Enviamos el post pasándole, los datos que queremos enviar. (esta función nos devuelve un código que guardamos en un int)
    if(codigo_respuesta>0){
      Serial.println("Código HTTP ► " + String(codigo_respuesta));   //Print return code
      if(codigo_respuesta == 200){
        String cuerpo_respuesta = http.getString();
        Serial.println("El servidor respondió ▼ ");
        Serial.println(cuerpo_respuesta);
        fugaGas = 0; // resetear la alarma 

      }
    }else{
     Serial.print("Error enviando POST, código: ");
     Serial.println(codigo_respuesta);
    }
    http.end();  //libero recursos
    }

    if(fuegoDetectado==1){
        String datos_a_enviar = "alarma_fuego=fuego detectado&correo="+correo;

        http.begin(client, url);        //Indicamos el destino
        http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.
        int codigo_respuesta = http.POST(datos_a_enviar);   //Enviamos el post pasándole, los datos que queremos enviar. (esta función nos devuelve un código que guardamos en un int)
        if(codigo_respuesta>0){
          Serial.println("Código HTTP ► " + String(codigo_respuesta));   //Print return code
          if(codigo_respuesta == 200){
            String cuerpo_respuesta = http.getString();
            Serial.println("El servidor respondió ▼ ");
            Serial.println(cuerpo_respuesta);
            fuegoDetectado = 0; // reseteando la alarma
          }
        }else{
        Serial.print("Error enviando POST, código: ");
        Serial.println(codigo_respuesta);
        }
        http.end();  //libero recursos
        }
  }else{

     Serial.println("Error en la conexión WIFI");

  }
  
}
#include <ESP8266WiFi.h>          //https://github.com/esp8266/Arduino
#include <DHT.h>
#include <ESP8266HTTPClient.h>
//needed for library
#include <DNSServer.h>
#include <ESP8266WebServer.h>
#include <WiFiManager.h>          //https://github.com/tzapu/WiFiManager

// Config DHT
#define DHTPIN D5
#define DHTTYPE DHT22
#define SECONDS_DS(seconds) ((seconds)*1000000UL)
#define figger_p  "6F 6A F7 71 0B F6 B9 98 0E 35 01 7F DA D4 A6 25 12 5C A7 A0"

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);
  WiFiManager wifiManager;
  wifiManager.setTimeout(180);
  if(!wifiManager.autoConnect("WIFI_AutoCON")) {
    Serial.println("failed to connect and hit timeout");
    delay(3000);
    ESP.reset();
    delay(5000);
  } 
  Serial.println("Connected.");

  dht.begin();
}

void loop() {
    float h = dht.readHumidity();
    float t = dht.readTemperature();
    float l = 0.0;
    float w = 0.0;

    if (isnan(h) || isnan(t)) {
      Serial.println("Failed to read from DHT sensor!");
      return;
    }

    HTTPClient http;
    String url = "https://<domain.com>/insert/?temp=" + String(t) + "&humi=" + String(h) + "&light=" + String(l) + "&weight=" + String(w);
    Serial.println("Send Data to: " + url);
    http.begin(url, figger_p);
    int httpCode = http.GET();
    if (httpCode > 0) {
        Serial.printf("[HTTP] GET code: %d", httpCode);
        if (httpCode == HTTP_CODE_OK) {
          String payload = http.getString();
          Serial.println(payload);
        }else{
          Serial.println("HTTP_ERROR");
        }
    }else{
        Serial.printf("[HTTP] GET failed, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();

    delay(SECONDS_DS(60));
    Serial.println("Delay 1 min");
}

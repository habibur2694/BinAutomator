/*
Post Method
*/
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>

// Wi-Fi Credentials
const char* ssid = "";
const char* password = "";

WiFiClient client;
HTTPClient http;

void setup() {
  Serial.begin(9600);
  delay(1000);
  Serial.println("\n\n Welcome To BinAutomator\n");
  setup_wifi();
}
void loop() {
  //Check WiFi connection status
  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\n\nPerforming HTTP POST Request\n");

    // HTTP Details
    String serverUrl = "http://localhost/BinAutomator/BinAutomator.php";
    http.begin(client, serverUrl);
    //    http.setAuthorization("Basic token");
    //    http.setAuthorization("Bearer token");

    String body = "{\"name\":\"POST BinAutomator\"}";
    Serial.println("POST body: " + body);

    // Send HTTP POST request
    int httpResponseCode = http.POST(body);
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);

    if (httpResponseCode == HTTP_CODE_CREATED) {
      String payload = http.getString();
      Serial.println("Response payload: " + payload);

      DynamicJsonDocument doc(1024);
      deserializeJson(doc, payload);
      JsonObject obj = doc.as<JsonObject>();

      String response = obj[String("response")];
      Serial.println("\nresponse is : " + response);
    } else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    // Free resources
    http.end();
  } else {
    Serial.println("WiFi Disconnected");
  }
  delay(10000);
}

void setup_wifi() {
  delay(10);
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

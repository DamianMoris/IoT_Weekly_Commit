#include <SPI.h>
#include <Ethernet.h>
#include <SFE_BMP180.h>
SFE_BMP180 pressure;

// replace the MAC address below by the MAC address printed on a sticker on the Arduino Shield 2
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

EthernetClient client;

int    HTTP_PORT   = 80;
String HTTP_METHOD = "GET";
char   HOST_NAME[] = "11900357.pxl-ea-ict.be";
String PATH_NAME   = "/collector_data.php";
String queryString = "?temp=1&pressure=1";

void setup() {
  pressure.begin();
  Serial.begin(9600);

  // initialize the Ethernet shield using DHCP:
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to obtaining an IP address using DHCP");
    while(true);
  }

}

void loop() {
  double T;
  double P;
  //char* ST;
  //char* SP;

  delay(pressure.startTemperature());
  pressure.getTemperature(T);
  
  delay(pressure.startPressure(3));
  pressure.getPressure(P, T);

  Serial.print("Temp = ");
  Serial.print("   ");
  Serial.print(T);
  Serial.print("\n");
  Serial.print("Pres = ");
  Serial.print("   ");
  Serial.print(P);
  Serial.print("\n");

  String queryString = String("?temperature=") + String(T) + String("&pressure=") + String(P);

  // connect to web server on port 80:
  if(client.connect(HOST_NAME, HTTP_PORT)) {
    // if connected:
    Serial.println("Connected to server");
    // make a HTTP request:
    // send HTTP header
    client.println(HTTP_METHOD + " " + PATH_NAME + queryString + " HTTP/1.1");
    client.println("Host: " + String(HOST_NAME));
    client.println("Connection: close");
    client.println(); // end HTTP header

    // send HTTP body
    client.println(queryString);

    while(client.connected()) {
      if(client.available()){
        // read an incoming byte from the server and print it to serial monitor:
        char c = client.read();
        Serial.print(c);
      }
    }

    // the server's disconnected, stop the client:
    client.stop();
    Serial.println();
    Serial.println("disconnected");
  } else {// if not connected:
    Serial.println("connection failed");
  }
  delay(180000);
}

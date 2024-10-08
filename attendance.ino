#include <SPI.h>  // to communicate with devices over the I2C and SPI buses
#include <Wire.h>
#include <FPS_GT511C3.h>
#include <WiFiClient.h>            //Creates a client that can connect to to a specified internet IP address
#include <ESP8266WiFi.h>           //uses the ESP8266 to connect to Wifi
#include <SoftwareSerial.h>        //serial communication on other digital pins
#include <ESP8266WebServer.h>      //host web pages and serve content over Wi-Fi
#include <ESP8266HTTPClient.h>     //http requests like GET or POST
#include <Adafruit_GFX.h>          //for oled        //https://github.com/adafruit/Adafruit-GFX-Library
#include <Adafruit_SSD1306.h>      //for oled    //https://github.com/adafruit/Adafruit_SSD1306
#include <Adafruit_Fingerprint.h>  //https://github.com/adafruit/Adafruit-Fingerprint-Sensor-Library
/// Declaration for SSD1306 display connected using software I2C
#define SCREEN_WIDTH 128  // OLED display width, in pixels
#define SCREEN_HEIGHT 64  // OLED display height, in pixels
#define OLED_RESET 0      // Reset pin # (or -1 if sharing Arduino reset pin)
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);
//************************************************************************
//*************************Biometric Icons*********************************
#define FinPr_start_width 64
#define FinPr_start_height 64
const uint8_t PROGMEM FinPr_start_bits[] = {
  0x00, 0x00, 0x00, 0x1f, 0xe0, 0x00, 0x00, 0x00, 0x00, 0x00, 0x01, 0xff, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x00, 0x03, 0xff, 0xff, 0x80, 0x00, 0x00, 0x00, 0x00, 0x0f, 0xc0, 0x0f, 0xe0, 0x00, 0x00, 0x00, 0x00, 0x1f, 0x00, 0x01, 0xf8, 0x00, 0x00, 0x00, 0x00, 0x3c, 0x00, 0x00, 0x7c, 0x00, 0x00, 0x00, 0x00, 0x78, 0x00, 0x00, 0x3e, 0x00, 0x00, 0x00, 0x00, 0xf0, 0x3f, 0xf8, 0x0f, 0x00, 0x00, 0x00, 0x01, 0xe0, 0xff, 0xfe, 0x07, 0x80, 0x00, 0x00, 0x03, 0xc3, 0xff, 0xff, 0x03, 0x80, 0x00, 0x00, 0x03, 0x87, 0xc0, 0x07, 0xc3, 0xc0, 0x00, 0x00, 0x07, 0x0f, 0x00, 0x03, 0xe1, 0xc0, 0x00, 0x00, 0x0f, 0x0e, 0x00, 0x00, 0xe0, 0xe0, 0x00, 0x00, 0x0e, 0x1c, 0x00, 0x00, 0xf0, 0xe0, 0x00, 0x00, 0x0c, 0x3c, 0x1f, 0xe0, 0x70, 0xe0, 0x00, 0x00, 0x00, 0x38, 0x3f, 0xf0, 0x38, 0x70, 0x00, 0x00, 0x00, 0x78, 0x78, 0xf8, 0x38, 0x70, 0x00, 0x00, 0x00, 0x70, 0x70, 0x3c, 0x18, 0x70, 0x00, 0x00, 0x00, 0xe0, 0xe0, 0x1e, 0x1c, 0x70, 0x00, 0x00, 0x03, 0xe1, 0xe0, 0x0e, 0x1c, 0x70, 0x00, 0x00, 0x0f, 0xc1, 0xc3, 0x0e, 0x1c, 0x70, 0x00, 0x00, 0x3f, 0x03, 0xc3, 0x8e, 0x1c, 0x70, 0x00, 0x00, 0x3e, 0x03, 0x87, 0x0e, 0x1c, 0x70, 0x00, 0x00, 0x30, 0x07, 0x07, 0x0e, 0x18, 0xe0, 0x00, 0x00, 0x00, 0x0e, 0x0e, 0x0e, 0x38, 0xe0, 0x00, 0x00, 0x00, 0x3e, 0x1e, 0x1e, 0x38, 0xe0, 0x00, 0x00, 0x00, 0xf8, 0x1c, 0x1c, 0x38, 0xe0, 0x00, 0x00, 0x03, 0xf0, 0x38, 0x3c, 0x38, 0xe0, 0x00, 0x00, 0x3f, 0xc0, 0xf8, 0x78, 0x38, 0xe0, 0x00, 0x00, 0x7f, 0x01, 0xf0, 0x70, 0x38, 0xf0, 0x00, 0x00, 0x78, 0x03, 0xe0, 0xe0, 0x38, 0x70, 0x00, 0x00, 0x00, 0x0f, 0x81, 0xe0, 0x38, 0x7c, 0x00, 0x00, 0x00, 0x3f, 0x03, 0xc0, 0x38, 0x3e, 0x00, 0x00, 0x00, 0xfc, 0x0f, 0x80, 0x38, 0x1e, 0x00, 0x00, 0x07, 0xf0, 0x1f, 0x1c, 0x1c, 0x04, 0x00, 0x00, 0x3f, 0xc0, 0x3e, 0x3f, 0x1e, 0x00, 0x00, 0x00, 0x7f, 0x00, 0xf8, 0x7f, 0x0f, 0x00, 0x00, 0x00, 0x38, 0x01, 0xf0, 0xf7, 0x07, 0xc0, 0x00, 0x00, 0x00, 0x07, 0xe1, 0xe3, 0x83, 0xf8, 0x00, 0x00, 0x00, 0x3f, 0x87, 0xc3, 0xc0, 0xfc, 0x00, 0x00, 0x01, 0xfe, 0x0f, 0x81, 0xe0, 0x3c, 0x00, 0x00, 0x0f, 0xf8, 0x1f, 0x00, 0xf0, 0x00, 0x00, 0x00, 0x1f, 0xc0, 0x7c, 0x00, 0x7c, 0x00, 0x00, 0x00, 0x1e, 0x01, 0xf8, 0x00, 0x3f, 0x00, 0x00, 0x00, 0x00, 0x07, 0xe0, 0x78, 0x0f, 0xc0, 0x00, 0x00, 0x00, 0x3f, 0x81, 0xfe, 0x07, 0xf0, 0x00, 0x00, 0x01, 0xfe, 0x07, 0xff, 0x01, 0xf0, 0x00, 0x00, 0x07, 0xf8, 0x0f, 0x87, 0x80, 0x30, 0x00, 0x00, 0x07, 0xc0, 0x3f, 0x03, 0xe0, 0x00, 0x00, 0x00, 0x06, 0x00, 0xfc, 0x01, 0xf8, 0x00, 0x00, 0x00, 0x00, 0x03, 0xf0, 0x00, 0x7e, 0x00, 0x00, 0x00, 0x00, 0x0f, 0xc0, 0x00, 0x3f, 0x80, 0x00, 0x00, 0x00, 0x7f, 0x00, 0xf8, 0x0f, 0x80, 0x00, 0x00, 0x00, 0xfc, 0x03, 0xfe, 0x01, 0x80, 0x00, 0x00, 0x00, 0xf0, 0x1f, 0xff, 0x80, 0x00, 0x00, 0x00, 0x00, 0x00, 0x7f, 0x07, 0xe0, 0x00, 0x00, 0x00, 0x00, 0x00, 0xfc, 0x03, 0xf8, 0x00, 0x00, 0x00, 0x00, 0x03, 0xf0, 0x00, 0x78, 0x00, 0x00, 0x00, 0x00, 0x0f, 0xc0, 0x00, 0x18, 0x00, 0x00, 0x00, 0x00, 0x0f, 0x01, 0xf8, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x07, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x1f, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x1e, 0x0e, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x18, 0x00, 0x00, 0x00, 0x00
};
//---------------------------------------------------------------
#define FinPr_valid_width 64
#define FinPr_valid_height 64
const uint8_t PROGMEM FinPr_valid_bits[] = {
  0x00, 0x00, 0x03, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x1f, 0xff, 0xe0, 0x00, 0x00, 0x00, 0x00, 0x00, 0x7f, 0xff, 0xf8, 0x00, 0x00, 0x00, 0x00, 0x00, 0xfc, 0x00, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x03, 0xe0, 0x00, 0x1f, 0x00, 0x00, 0x00, 0x00, 0x07, 0xc0, 0x00, 0x07, 0x80, 0x00, 0x00, 0x00, 0x0f, 0x80, 0x00, 0x03, 0xe0, 0x00, 0x00, 0x00, 0x0e, 0x03, 0xff, 0x01, 0xe0, 0x00, 0x00, 0x00, 0x1c, 0x1f, 0xff, 0xe0, 0xf0, 0x00, 0x00, 0x00, 0x3c, 0x3f, 0xff, 0xf0, 0x78, 0x00, 0x00, 0x00, 0x78, 0x7c, 0x00, 0xf8, 0x3c, 0x00, 0x00, 0x00, 0x70, 0xf0, 0x00, 0x3c, 0x1c, 0x00, 0x00, 0x00, 0xe1, 0xe0, 0x00, 0x1e, 0x1c, 0x00, 0x00, 0x00, 0xe1, 0xc0, 0x00, 0x0f, 0x0e, 0x00, 0x00, 0x00, 0xc3, 0x81, 0xfc, 0x07, 0x0e, 0x00, 0x00, 0x00, 0x03, 0x83, 0xff, 0x07, 0x8e, 0x00, 0x00, 0x00, 0x07, 0x07, 0x8f, 0x83, 0x87, 0x00, 0x00, 0x00, 0x0f, 0x0f, 0x03, 0xc3, 0x87, 0x00, 0x00, 0x00, 0x1e, 0x0e, 0x01, 0xc3, 0x87, 0x00, 0x00, 0x00, 0x3c, 0x1c, 0x00, 0xe1, 0x87, 0x00, 0x00, 0x00, 0xf8, 0x1c, 0x30, 0xe1, 0x87, 0x00, 0x00, 0x07, 0xf0, 0x38, 0x70, 0xe1, 0x86, 0x00, 0x00, 0x07, 0xc0, 0x78, 0x70, 0xe3, 0x8e, 0x00, 0x00, 0x02, 0x00, 0xf0, 0xf0, 0xe3, 0x8e, 0x00, 0x00, 0x00, 0x01, 0xe0, 0xe0, 0xe3, 0x8e, 0x00, 0x00, 0x00, 0x03, 0xc1, 0xe1, 0xc3, 0x8e, 0x00, 0x00, 0x00, 0x0f, 0x83, 0xc3, 0xc3, 0x8e, 0x00, 0x00, 0x00, 0x7f, 0x07, 0x83, 0x83, 0x0e, 0x00, 0x00, 0x07, 0xfc, 0x0f, 0x07, 0x83, 0x0e, 0x00, 0x00, 0x07, 0xf0, 0x1e, 0x0f, 0x03, 0x0e, 0x00, 0x00, 0x07, 0x80, 0x7c, 0x1e, 0x03, 0x07, 0x00, 0x00, 0x00, 0x00, 0xf8, 0x3c, 0x03, 0x87, 0x80, 0x00, 0x00, 0x03, 0xf0, 0x78, 0x03, 0x83, 0xc0, 0x00, 0x00, 0x1f, 0xc0, 0xf0, 0x02, 0x00, 0x00, 0x00, 0x00, 0xff, 0x01, 0xe1, 0xc0, 0x0c, 0x00, 0x00, 0x07, 0xfc, 0x03, 0xc3, 0xe1, 0xff, 0xc0, 0x00, 0x07, 0xe0, 0x0f, 0x87, 0xc7, 0xff, 0xf0, 0x00, 0x07, 0x00, 0x3f, 0x0f, 0x0f, 0xff, 0xfc, 0x00, 0x00, 0x00, 0x7c, 0x3e, 0x3f, 0xff, 0xfe, 0x00, 0x00, 0x03, 0xf8, 0x7c, 0x3f, 0xff, 0xff, 0x00, 0x00, 0x1f, 0xe0, 0xf0, 0x7f, 0xff, 0xff, 0x80, 0x00, 0xff, 0x83, 0xe0, 0xff, 0xff, 0xff, 0x80, 0x01, 0xfc, 0x07, 0xc1, 0xff, 0xff, 0xe3, 0xc0, 0x01, 0xe0, 0x1f, 0x01, 0xff, 0xff, 0xc3, 0xc0, 0x00, 0x00, 0xfe, 0x01, 0xff, 0xff, 0x87, 0xe0, 0x00, 0x03, 0xf8, 0x13, 0xff, 0xff, 0x0f, 0xe0, 0x00, 0x1f, 0xe0, 0x73, 0xff, 0xfe, 0x1f, 0xe0, 0x00, 0x7f, 0x81, 0xf3, 0xff, 0xfc, 0x1f, 0xe0, 0x00, 0xfc, 0x03, 0xe3, 0xef, 0xf8, 0x3f, 0xe0, 0x00, 0x60, 0x0f, 0xc3, 0xc7, 0xf0, 0x7f, 0xe0, 0x00, 0x00, 0x3f, 0x03, 0xc3, 0xe0, 0xff, 0xe0, 0x00, 0x00, 0xfc, 0x03, 0xc1, 0xc1, 0xff, 0xe0, 0x00, 0x07, 0xf0, 0x13, 0xe0, 0x83, 0xff, 0xe0, 0x00, 0x0f, 0xc0, 0x7b, 0xf8, 0x07, 0xff, 0xe0, 0x00, 0x0f, 0x01, 0xf9, 0xfc, 0x0f, 0xff, 0xc0, 0x00, 0x00, 0x07, 0xf1, 0xfe, 0x1f, 0xff, 0xc0, 0x00, 0x00, 0x1f, 0xc0, 0xff, 0x3f, 0xff, 0x80, 0x00, 0x00, 0x7e, 0x00, 0xff, 0xff, 0xff, 0x80, 0x00, 0x00, 0xfc, 0x00, 0x7f, 0xff, 0xff, 0x00, 0x00, 0x00, 0xf0, 0x1f, 0x3f, 0xff, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x7f, 0x1f, 0xff, 0xfc, 0x00, 0x00, 0x00, 0x01, 0xff, 0x8f, 0xff, 0xf8, 0x00, 0x00, 0x00, 0x03, 0xe0, 0xe3, 0xff, 0xe0, 0x00, 0x00, 0x00, 0x01, 0x80, 0x00, 0x7f, 0x00, 0x00
};
//---------------------------------------------------------------
#define FinPr_invalid_width 64
#define FinPr_invalid_height 64
const uint8_t PROGMEM FinPr_invalid_bits[] = {
  0x00, 0x00, 0x03, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x1f, 0xff, 0xe0, 0x00, 0x00, 0x00, 0x00, 0x00, 0x7f, 0xff, 0xf8, 0x00, 0x00, 0x00, 0x00, 0x00, 0xfc, 0x00, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x03, 0xe0, 0x00, 0x1f, 0x00, 0x00, 0x00, 0x00, 0x07, 0xc0, 0x00, 0x07, 0x80, 0x00, 0x00, 0x00, 0x0f, 0x80, 0x00, 0x03, 0xe0, 0x00, 0x00, 0x00, 0x0e, 0x03, 0xff, 0x01, 0xe0, 0x00, 0x00, 0x00, 0x1c, 0x1f, 0xff, 0xe0, 0xf0, 0x00, 0x00, 0x00, 0x3c, 0x3f, 0xff, 0xf0, 0x78, 0x00, 0x00, 0x00, 0x78, 0x7c, 0x00, 0xf8, 0x3c, 0x00, 0x00, 0x00, 0x70, 0xf0, 0x00, 0x3c, 0x1c, 0x00, 0x00, 0x00, 0xe1, 0xe0, 0x00, 0x1e, 0x1c, 0x00, 0x00, 0x00, 0xe1, 0xc0, 0x00, 0x0f, 0x0e, 0x00, 0x00, 0x00, 0xc3, 0x81, 0xfc, 0x07, 0x0e, 0x00, 0x00, 0x00, 0x03, 0x83, 0xff, 0x07, 0x8e, 0x00, 0x00, 0x00, 0x07, 0x07, 0x8f, 0x83, 0x87, 0x00, 0x00, 0x00, 0x0f, 0x0f, 0x03, 0xc3, 0x87, 0x00, 0x00, 0x00, 0x1e, 0x0e, 0x01, 0xc3, 0x87, 0x00, 0x00, 0x00, 0x3c, 0x1c, 0x00, 0xe1, 0x87, 0x00, 0x00, 0x00, 0xf8, 0x1c, 0x30, 0xe1, 0x87, 0x00, 0x00, 0x07, 0xf0, 0x38, 0x70, 0xe1, 0x86, 0x00, 0x00, 0x07, 0xc0, 0x78, 0x70, 0xe3, 0x8e, 0x00, 0x00, 0x02, 0x00, 0xf0, 0xf0, 0xe3, 0x8e, 0x00, 0x00, 0x00, 0x01, 0xe0, 0xe0, 0xe3, 0x8e, 0x00, 0x00, 0x00, 0x03, 0xc1, 0xe1, 0xc3, 0x8e, 0x00, 0x00, 0x00, 0x0f, 0x83, 0xc3, 0xc3, 0x8e, 0x00, 0x00, 0x00, 0x7f, 0x07, 0x83, 0x83, 0x0e, 0x00, 0x00, 0x07, 0xfc, 0x0f, 0x07, 0x83, 0x0e, 0x00, 0x00, 0x07, 0xf0, 0x1e, 0x0f, 0x03, 0x0e, 0x00, 0x00, 0x07, 0x80, 0x7c, 0x1e, 0x03, 0x07, 0x00, 0x00, 0x00, 0x00, 0xf8, 0x3c, 0x03, 0x87, 0x80, 0x00, 0x00, 0x03, 0xf0, 0x78, 0x03, 0x83, 0xc0, 0x00, 0x00, 0x1f, 0xc0, 0xf0, 0x02, 0x00, 0x00, 0x00, 0x00, 0xff, 0x01, 0xe1, 0xc0, 0x00, 0x00, 0x00, 0x07, 0xfc, 0x03, 0xc3, 0xe1, 0xff, 0xc0, 0x00, 0x07, 0xe0, 0x0f, 0x87, 0xc7, 0xff, 0xf0, 0x00, 0x07, 0x00, 0x3f, 0x0f, 0x0f, 0xff, 0xf8, 0x00, 0x00, 0x00, 0x7c, 0x3e, 0x1f, 0xff, 0xfe, 0x00, 0x00, 0x03, 0xf8, 0x7c, 0x3f, 0xff, 0xff, 0x00, 0x00, 0x1f, 0xe0, 0xf0, 0x7f, 0xff, 0xff, 0x00, 0x00, 0xff, 0x83, 0xe0, 0xfe, 0xff, 0xbf, 0x80, 0x01, 0xfc, 0x07, 0xc0, 0xfc, 0x7f, 0x1f, 0xc0, 0x01, 0xe0, 0x1f, 0x01, 0xf8, 0x3e, 0x0f, 0xc0, 0x00, 0x00, 0xfe, 0x01, 0xf8, 0x1c, 0x07, 0xe0, 0x00, 0x03, 0xf8, 0x13, 0xf8, 0x00, 0x0f, 0xe0, 0x00, 0x1f, 0xe0, 0x73, 0xfc, 0x00, 0x1f, 0xe0, 0x00, 0x7f, 0x81, 0xf3, 0xfe, 0x00, 0x3f, 0xe0, 0x00, 0xfc, 0x03, 0xe3, 0xff, 0x00, 0x7f, 0xe0, 0x00, 0x60, 0x0f, 0xc3, 0xff, 0x80, 0xff, 0xe0, 0x00, 0x00, 0x3f, 0x03, 0xff, 0x00, 0x7f, 0xe0, 0x00, 0x00, 0xfc, 0x03, 0xfe, 0x00, 0x3f, 0xe0, 0x00, 0x07, 0xf0, 0x13, 0xfc, 0x00, 0x1f, 0xe0, 0x00, 0x0f, 0xc0, 0x79, 0xf8, 0x08, 0x0f, 0xe0, 0x00, 0x0f, 0x01, 0xf9, 0xf8, 0x1c, 0x0f, 0xc0, 0x00, 0x00, 0x07, 0xf1, 0xfc, 0x3e, 0x1f, 0xc0, 0x00, 0x00, 0x1f, 0xc0, 0xfe, 0x7f, 0x3f, 0x80, 0x00, 0x00, 0x7e, 0x00, 0xff, 0xff, 0xff, 0x80, 0x00, 0x00, 0xfc, 0x00, 0x7f, 0xff, 0xff, 0x00, 0x00, 0x00, 0xf0, 0x1f, 0x3f, 0xff, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x7f, 0x1f, 0xff, 0xfc, 0x00, 0x00, 0x00, 0x01, 0xff, 0x8f, 0xff, 0xf8, 0x00, 0x00, 0x00, 0x03, 0xe0, 0xe3, 0xff, 0xe0, 0x00, 0x00, 0x00, 0x01, 0x80, 0x00, 0x7f, 0x00, 0x00
};
//---------------------------------------------------------------
#define FinPr_failed_width 64
#define FinPr_failed_height 64
const uint8_t PROGMEM FinPr_failed_bits[] = {
  0x00, 0x00, 0x3f, 0xe0, 0x00, 0x00, 0x00, 0x00, 0x00, 0x01, 0xff, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x00, 0x0f, 0xc0, 0x1f, 0x80, 0x00, 0x00, 0x00, 0x00, 0x1e, 0x00, 0x03, 0xc0, 0x00, 0x00, 0x00, 0x00, 0x78, 0x00, 0x00, 0xf0, 0x00, 0x00, 0x00, 0x00, 0xe0, 0x00, 0x00, 0x38, 0x00, 0x00, 0x00, 0x01, 0xc0, 0x00, 0x00, 0x1c, 0x00, 0x00, 0x00, 0x03, 0x80, 0x00, 0x00, 0x0e, 0x00, 0x00, 0x00, 0x07, 0x00, 0x7f, 0xe0, 0x07, 0x00, 0x00, 0x00, 0x06, 0x01, 0xff, 0xf8, 0x03, 0x00, 0x00, 0x00, 0x0c, 0x03, 0xc0, 0x3c, 0x03, 0x80, 0x00, 0x00, 0x1c, 0x0f, 0x00, 0x0e, 0x01, 0x80, 0x00, 0x00, 0x18, 0x0c, 0x00, 0x03, 0x00, 0xc0, 0x00, 0x00, 0x18, 0x18, 0x00, 0x01, 0x80, 0xc0, 0x00, 0x00, 0x30, 0x38, 0x00, 0x01, 0xc0, 0xe0, 0x00, 0x00, 0x30, 0x30, 0x0f, 0x00, 0xc0, 0x60, 0x00, 0x00, 0x30, 0x30, 0x3f, 0xc0, 0xe0, 0x60, 0x00, 0x00, 0x70, 0x60, 0x78, 0xe0, 0x60, 0x60, 0x00, 0x00, 0x60, 0x60, 0x60, 0x60, 0x60, 0x70, 0x00, 0x00, 0x60, 0x60, 0x60, 0x60, 0x60, 0x30, 0x00, 0x00, 0x60, 0x60, 0x60, 0x60, 0x30, 0x30, 0x00, 0x00, 0x60, 0x60, 0x60, 0x30, 0x30, 0x20, 0x00, 0x00, 0x60, 0x60, 0x60, 0x30, 0x30, 0x01, 0xe0, 0x00, 0x60, 0x60, 0x60, 0x30, 0x30, 0x0f, 0xfc, 0x00, 0x60, 0x60, 0x60, 0x30, 0x30, 0x3f, 0xff, 0x00, 0x60, 0x60, 0x60, 0x30, 0x18, 0x78, 0x03, 0x80, 0x60, 0x60, 0x60, 0x30, 0x1c, 0x60, 0x01, 0x80, 0x60, 0x60, 0x30, 0x38, 0x0c, 0xc0, 0x00, 0xc0, 0x00, 0x60, 0x30, 0x18, 0x00, 0xc0, 0x00, 0xc0, 0x00, 0x60, 0x30, 0x18, 0x00, 0xc0, 0x00, 0xc0, 0x00, 0xe0, 0x30, 0x0c, 0x01, 0xc0, 0x00, 0xe0, 0x00, 0xc0, 0x18, 0x0e, 0x01, 0xc0, 0x00, 0xe0, 0x60, 0xc0, 0x18, 0x07, 0x01, 0xc0, 0x00, 0xe0, 0x01, 0xc0, 0x1c, 0x03, 0x81, 0xc0, 0x00, 0xe0, 0x01, 0x80, 0x0c, 0x01, 0xc1, 0xc0, 0x00, 0xe0, 0x03, 0x80, 0x0e, 0x00, 0xf1, 0xc0, 0x00, 0xe0, 0x0f, 0x00, 0x06, 0x00, 0x01, 0xc0, 0x00, 0xe0, 0x3e, 0x01, 0x03, 0x00, 0x01, 0xc0, 0x00, 0xe0, 0x30, 0x03, 0x83, 0x80, 0x1f, 0xff, 0xff, 0xfe, 0x00, 0x03, 0x81, 0xc0, 0x3f, 0xff, 0xff, 0xff, 0x00, 0x07, 0xc0, 0xe0, 0x30, 0x00, 0x00, 0x03, 0x00, 0x0e, 0xc0, 0x78, 0x30, 0x00, 0x00, 0x03, 0x00, 0x3c, 0x60, 0x1e, 0x30, 0x00, 0x00, 0x03, 0x00, 0x78, 0x70, 0x0f, 0x30, 0x00, 0x00, 0x03, 0x03, 0xe0, 0x38, 0x03, 0x30, 0x00, 0x00, 0x03, 0x07, 0x80, 0x1c, 0x00, 0x30, 0x00, 0x00, 0x03, 0xc0, 0x00, 0x0f, 0x00, 0x30, 0x00, 0x00, 0x03, 0xc0, 0x00, 0x03, 0x80, 0x30, 0x01, 0xe0, 0x03, 0x00, 0x18, 0x01, 0xe0, 0x30, 0x03, 0xf0, 0x03, 0x00, 0x18, 0x00, 0x7c, 0x30, 0x07, 0x38, 0x03, 0x00, 0x0c, 0x00, 0x1f, 0x30, 0x06, 0x18, 0x03, 0x18, 0x0e, 0x00, 0x07, 0x30, 0x06, 0x18, 0x03, 0x0c, 0x07, 0x80, 0x00, 0x30, 0x07, 0x38, 0x03, 0x0e, 0x03, 0xc0, 0x00, 0x30, 0x03, 0x30, 0x03, 0x07, 0x00, 0xf0, 0x00, 0x30, 0x03, 0x30, 0x03, 0x03, 0x00, 0x7e, 0x00, 0x30, 0x03, 0x30, 0x03, 0x01, 0x80, 0x1f, 0xc0, 0x30, 0x03, 0x30, 0x03, 0x01, 0xc0, 0x03, 0xe1, 0x30, 0x07, 0xf8, 0x03, 0x00, 0xf0, 0x00, 0x01, 0x30, 0x03, 0xf0, 0x03, 0x00, 0x38, 0x00, 0x00, 0x30, 0x00, 0x00, 0x03, 0x00, 0x1e, 0x00, 0x00, 0x30, 0x00, 0x00, 0x03, 0x00, 0x07, 0xc0, 0x00, 0x30, 0x00, 0x00, 0x03, 0x00, 0x01, 0xff, 0x80, 0x3f, 0xff, 0xff, 0xff, 0x00, 0x00, 0x3f, 0x80, 0x1f, 0xff, 0xff, 0xfe
};
//---------------------------------------------------------------
#define FinPr_scan_width 64
#define FinPr_scan_height 64
const uint8_t PROGMEM FinPr_scan_bits[] = {
  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x1f, 0xf8, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x7f, 0xff, 0x00, 0x00, 0x00, 0x00, 0x00, 0x01, 0xfc, 0x7f, 0xc0, 0x00, 0x00, 0x00, 0x00, 0x03, 0xc0, 0x03, 0xe0, 0x00, 0x00, 0x00, 0x00, 0x07, 0x80, 0x00, 0xf0, 0x00, 0x00, 0x00, 0x00, 0x0e, 0x00, 0x00, 0x3c, 0x00, 0x00, 0x00, 0x00, 0x1c, 0x1f, 0xfc, 0x1c, 0x00, 0x00, 0x00, 0x00, 0x38, 0x7f, 0xfe, 0x0e, 0x00, 0x00, 0x00, 0x00, 0x78, 0xf8, 0x0f, 0x87, 0x00, 0x00, 0x00, 0x00, 0x71, 0xe0, 0x03, 0xc7, 0x00, 0x00, 0x00, 0x00, 0xe3, 0x80, 0x01, 0xc3, 0x80, 0x00, 0x00, 0x00, 0xc3, 0x83, 0xc0, 0xe3, 0x80, 0x00, 0x00, 0x00, 0xc7, 0x0f, 0xf0, 0x71, 0x80, 0x00, 0x00, 0x00, 0x06, 0x1f, 0xf8, 0x71, 0xc0, 0x00, 0x00, 0x00, 0x0e, 0x1c, 0x3c, 0x31, 0xc0, 0x00, 0x00, 0x00, 0x1c, 0x38, 0x1c, 0x31, 0xc0, 0x00, 0x00, 0x00, 0x38, 0x70, 0x0e, 0x39, 0xc0, 0x00, 0x00, 0x01, 0xf0, 0x71, 0x8e, 0x39, 0xc0, 0x00, 0x00, 0x03, 0xe0, 0xe1, 0x86, 0x31, 0xc0, 0x00, 0x00, 0x03, 0x81, 0xe3, 0x8e, 0x31, 0x80, 0x00, 0x00, 0x00, 0x03, 0xc3, 0x8e, 0x33, 0x80, 0x00, 0x00, 0x00, 0x07, 0x87, 0x0c, 0x73, 0x80, 0x00, 0x00, 0x00, 0x1f, 0x0e, 0x1c, 0x73, 0x80, 0x00, 0x7f, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xfe, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0x7f, 0xff, 0xff, 0xff, 0xff, 0xff, 0xff, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x03, 0xf0, 0x1e, 0x3e, 0x1c, 0x00, 0x00, 0x00, 0x03, 0x80, 0x7c, 0x77, 0x0f, 0x00, 0x00, 0x00, 0x00, 0x01, 0xf0, 0xe3, 0x07, 0xc0, 0x00, 0x00, 0x00, 0x07, 0xe3, 0xc3, 0x81, 0xf0, 0x00, 0x00, 0x00, 0x3f, 0x87, 0x81, 0xc0, 0x60, 0x00, 0x00, 0x01, 0xfc, 0x1f, 0x00, 0xf0, 0x00, 0x00, 0x00, 0x01, 0xe0, 0x3c, 0x00, 0x7c, 0x00, 0x00, 0x00, 0x00, 0x00, 0xf8, 0x78, 0x1f, 0x00, 0x00, 0x00, 0x00, 0x07, 0xe0, 0xfc, 0x0f, 0xc0, 0x00, 0x00, 0x00, 0x3f, 0x83, 0xef, 0x03, 0xc0, 0x00, 0x00, 0x00, 0xfc, 0x0f, 0x87, 0x80, 0x00, 0x00, 0x00, 0x00, 0x70, 0x1f, 0x03, 0xe0, 0x00, 0x00, 0x00, 0x00, 0x00, 0x7c, 0x00, 0xf8, 0x00, 0x00, 0x00, 0x00, 0x01, 0xf0, 0x00, 0x3e, 0x00, 0x00, 0x00, 0x00, 0x0f, 0xc0, 0xf8, 0x0f, 0x00, 0x00, 0x00, 0x00, 0x1f, 0x03, 0xfe, 0x02, 0x00, 0x00, 0x00, 0x00, 0x0c, 0x0f, 0x8f, 0x80, 0x00, 0x00, 0x00, 0x00, 0x00, 0x3f, 0x03, 0xe0, 0x00, 0x00, 0x00, 0x00, 0x00, 0xf8, 0x00, 0xf0, 0x00, 0x00, 0x00, 0x00, 0x01, 0xe0, 0x00, 0x30, 0x00, 0x00, 0x00, 0x00, 0x01, 0xc0, 0xf8, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x07, 0xfe, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x0f, 0x8e, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x06, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00
};
//************************************************************************

// ...................USER MUST CHANGE THIS FIELD................................................................
const char *ssid = "";     //ENTER YOUR WIFI SETTINGS
const char *password = "";  // ENTER YOUR PASSWORD
String link = "http://192.168.20.208/sensor.php";  // REPLACE 192.168.20.208 WITH YOUR LAMP IPV4 ADDRESS
//................................................................................................................


String postdata;
FPS_GT511C3 fps(D5, D6);
int num = 1;
void setup() {
  Serial.begin(9600);
  connectToWiFi();
  fps.UseSerialDebug = true;  // so you can see the messages in the serial debug screen
  fps.Open();
  fps.SetLED(true);
  //-----------initiate OLED display-------------

  // SSD1306_SWITCHCAPVCC = generate display voltage from 3.3V internally
  if (!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {  // Address 0x3D for 128x64
    Serial.println(F("SSD1306 allocation failed"));
    for (;;)
      ;  // Don't proceed, loop forever
  }
  // Show initial display buffer contents on the screen --
  // the library initializes this with an Adafruit splash screen.
  // you can delet these three lines if you don't want to get the Adfruit logo appear
  display.display();
  delay(2000);  // Pause for 2 seconds
  display.clearDisplay();

  //---------------------------------------------
  delay(2000);  // Pause for 2 seconds
}

void loop() {
  if (WiFi.status() != WL_CONNECTED) {
    connectToWiFi();
  }

  display.clearDisplay();
  display.drawBitmap(32, 0, FinPr_start_bits, FinPr_start_width, FinPr_start_height, WHITE);
  display.display();
  ready();
}

void ready()
{
   // send ready signal to server
  String payload = senddata("ready");

  if (payload == "check") 
  {
    int fingerid = check();
    if(fingerid == -1)
    {
      ready();
    }
    else
    {
      String send = "verified=" + String(fingerid);
      String msg = senddata(send);
      oleddisplay(msg);
      delay(7000);
    }
    
  } 
  else 
  {
    int pos = payload.indexOf("=");
    if (pos != -1) 
    {
      String before = payload.substring(0, pos);
      String after = payload.substring(pos + 1);
      int fingerid = after.toInt();

      if (before == "enroll") 
      {
        int value = enroll(fingerid);
        if(value == -1)
        {
          ready();
        }
        else
        {
          String send = "enrolled=" + String(value);
          String msg = senddata(send);
          oleddisplay(msg);
          delay(10000);
        }
      }
    }
  }
}

int enroll(int num) {
  int enrollid = num;
  Serial.println(enrollid);
  delay(3000);
  display.clearDisplay();
  display.drawBitmap(32, 0, FinPr_start_bits, FinPr_start_width, FinPr_start_height, WHITE);
  display.display();
  fps.EnrollStart(enrollid);
  fps.SetLED(true);
  Serial.println("Press finger to Enroll #");
  while (fps.IsPressFinger() == false) {
    display.clearDisplay();
    display.drawBitmap(32, 0, FinPr_scan_bits, FinPr_scan_width, FinPr_scan_height, WHITE);
    display.display();
    delay(500);
  }
  bool bret = fps.CaptureFinger(true);
  display.clearDisplay();
  display.drawBitmap(32, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
  display.display();
  int iret = 0;
  if (bret == true) {
    Serial.println("Remove your finger");
    fps.Enroll1();
    while (fps.IsPressFinger() == false) {
      display.clearDisplay();
      display.drawBitmap(32, 0, FinPr_scan_bits, FinPr_scan_width, FinPr_scan_height, WHITE);
      display.display();
      delay(500);
    }
    Serial.println("Press same finger again");
    bret = fps.CaptureFinger(true);
    display.clearDisplay();
    display.drawBitmap(32, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
    display.display();
    if (bret != false) {
      Serial.println("Remove finger");
      fps.Enroll2();
      while (fps.IsPressFinger() == false) {
        display.clearDisplay();
        display.drawBitmap(32, 0, FinPr_scan_bits, FinPr_scan_width, FinPr_scan_height, WHITE);
        display.display();
        delay(500);
      }
      Serial.println("Press same finger yet again");
      while (fps.IsPressFinger() == false) {
        display.clearDisplay();
        display.drawBitmap(32, 0, FinPr_scan_bits, FinPr_scan_width, FinPr_scan_height, WHITE);
        display.display();
        delay(500);
      }
      bret = fps.CaptureFinger(true);
      display.clearDisplay();
      display.drawBitmap(32, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
      display.display();
      if (bret != false) {
        Serial.println("Remove finger");
        iret = fps.Enroll3();
        while (fps.IsPressFinger() == false) {
          display.clearDisplay();
          display.drawBitmap(32, 0, FinPr_scan_bits, FinPr_scan_width, FinPr_scan_height, WHITE);
          display.display();
          delay(500);
        }
        if (iret == 0) {
          // Serial.println("Enrolling Successfull");
          display.clearDisplay();
          display.drawBitmap(32, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
          display.display();
          return enrollid;
        } else {
          Serial.print("Enrolling Failed with error code:");
          Serial.println(iret);
          return -1;
        }
      } else Serial.println("Failed to capture third finger");
      display.clearDisplay();
      display.drawBitmap(32, 0, FinPr_invalid_bits, FinPr_invalid_width, FinPr_invalid_height, WHITE);
      display.display();
      return -1;
    } else Serial.println("Failed to capture second finger");
    display.clearDisplay();
    display.drawBitmap(32, 0, FinPr_invalid_bits, FinPr_invalid_width, FinPr_invalid_height, WHITE);
    display.display();
    return -1;
  } else Serial.println("Failed to capture first finger");
  display.clearDisplay();
  display.drawBitmap(32, 0, FinPr_invalid_bits, FinPr_invalid_width, FinPr_invalid_height, WHITE);
  display.display();
  return -1;
}

int check() {
  display.clearDisplay();
  display.drawBitmap(32, 0, FinPr_scan_bits, FinPr_scan_width, FinPr_scan_height, WHITE);
  display.display();
  fps.IsPressFinger();
  display.clearDisplay();
  display.drawBitmap(32, 0, FinPr_scan_bits, FinPr_scan_width, FinPr_scan_height, WHITE);
  display.display();
  delay(500);
  if (fps.IsPressFinger()) {
    fps.CaptureFinger(false);
    int finger = fps.Identify1_N();

    if (finger > 0 && finger < 200) {
      Serial.print("Verified ID:");
      Serial.println(finger);
      display.clearDisplay();
      display.drawBitmap(32, 0, FinPr_valid_bits, FinPr_valid_width, FinPr_valid_height, WHITE);
      display.display();
      return finger;
    } else {
      Serial.println("Finger not found");
      display.clearDisplay();
      display.drawBitmap(32, 0, FinPr_invalid_bits, FinPr_invalid_width, FinPr_invalid_height, WHITE);
      display.display();
      return -1;
    }
  } else {
    Serial.println("Please press finger");
    display.clearDisplay();
    display.drawBitmap(32, 0, FinPr_start_bits, FinPr_start_width, FinPr_start_height, WHITE);
    display.display();
    return -1;
  }
  delay(1000);
}

void connectToWiFi() {
  WiFi.mode(WIFI_OFF);  //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);
  Serial.println("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println(".");
  }
}

String senddata(String data) {
  WiFiClient client;
  HTTPClient http;
  http.begin(client, link);
  int httpcode = http.POST(data);
  String payload = http.getString();
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  Serial.print("link: ");
  Serial.println(link);
  Serial.print("sending: ");
  Serial.println(data);
  Serial.print("httpcode: ");
  Serial.println(httpcode);
  Serial.print("payload: ");
  Serial.println(payload);
  Serial.println(".......................................");
  delay(1000);
  http.end();
  return payload;
}

void oleddisplay(String msg) {
  display.clearDisplay();
  display.setTextSize(1.5);     // Normal 1:1 pixel scale
  display.setTextColor(WHITE);  // Draw white text
  display.setCursor(0, 0);      // Start at top-left corner
  display.print(msg);
  display.display();
  delay(1000);
}

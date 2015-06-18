#!/usr/bin/python
# coding: utf-8

# In[11]:

#Clone the library from https://github.com/adafruit/Adafruit_Python_DHT
#Follow the steps mentioned there
import Adafruit_DHT
import time
import csv
import sys
import datetime
import requests
# In[12]:

def setup():
    #Access the sensor
    sensor = Adafruit_DHT.DHT11
    #This is BCM pin. Don't use board pin value which does not work here
    pin = 24 #Equivalent Board_pin value is 18
    return (sensor,pin)

def webcall(temp_c,temp_f,humidity):
	url = 'http://www.sowmiyan.com/IoT/dht11.php'
	payload = {'tme':str(datetime.datetime.now()),'temp_cel':temp_c,'temp_f':temp_f,'humidity':humidity}
	#print( str(datetime.datetime.now())+','+str(temperature)+','+ str(temperature*1.8+32)+','+ str(humidity))
	r = requests.get(url,params=payload)
	#print r.text
	#print r.status_code
# In[13]:

def loop(sensor, pin):
    try:
        while True:
            # Try to grab a sensor reading.  Use the read_retry method which will retry up
            # to 15 times to get a sensor reading (waiting 2 seconds between each retry).
            humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
            if humidity is not None and temperature is not None:
                #print 'Temp={0:0.1f}*C, {1:0.1f}*F Humidity={2:0.1f}%'.format(temperature, temperature*1.8+32, humidity)
		#print( str(datetime.datetime.now())+','+str(temperature)+','+ str(temperature*1.8+32)+','+ str(humidity))
		webcall(temperature, temperature*1.8+32, humidity)
                sys.stdout.flush()         
            else:
                print 'Failed to get reading. Try again!'
            time.sleep(60)
    except KeyboardInterrupt:
         print "Keyboad interrupt occured"
    except:
         print "Other type of interrupt occured"
    finally:
         print "Executing GPIO cleanup. No code is available"


# In[14]:

def main():
    sensor,pin = setup();
    loop(sensor,pin);


# In[15]:

if __name__ == "__main__":
    main()



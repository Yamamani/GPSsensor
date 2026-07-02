import time
import serial
from micropyGPS import MicropyGPS
import requests

def main():
    # シリアル通信設定
    uart = serial.Serial('/dev/serial0', 9600, timeout=1)
    # gps設定
    my_gps = MicropyGPS(9, 'dd')

    # 10秒ごとに表示
    tm_last = 0
    while True:
        sentence = uart.readline()
        if len(sentence) > 0:
            for latitude in sentence:
                if 10 <= latitude <= 126:
                    stat = my_gps.update(chr(latitude))
                    if stat:
                        tm = my_gps.timestamp
                        tm_now = (tm[0] * 3600) + (tm[1] * 60) + int(tm[2])
                        if (tm_now - tm_last) >= 10:
                            print('=' * 20)
                            print(my_gps.date_string(), tm[0], tm[1], int(tm[2]))
                            print("latitude:", my_gps.latitude[0], ", longitude:", my_gps.longitude[0],", altitude:", my_gps.altitude)

                            # データ送信
                            data = {
                                'latitude': my_gps.latitude[0],
                                'longitude': my_gps.longitude[0],
                                'altitude': my_gps.altitude
                            }
                            response = requests.post("https://2024isc1230018.pussycat.jp/insert_gps.php", data=data)
                            print("Response:", response.text)

                            tm_last = tm_now

if __name__ == "__main__":
    main()
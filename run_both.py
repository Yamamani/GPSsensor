import threading
import time
import subprocess

# sensor.pyの実行関数
def run_sensor():
    subprocess.run(["python3", "sensor.py"])

# gps.pyの実行関数
def run_gps():
    subprocess.run(["python3", "gps.py"])

if __name__ == "__main__":
    # センサーとGPSのスレッドを作成
    sensor_thread = threading.Thread(target=run_sensor)
    gps_thread = threading.Thread(target=run_gps)

    # スレッドを開始
    sensor_thread.start()
    gps_thread.start()

    # 両方のスレッドが終了するまで待つ
    sensor_thread.join()
    gps_thread.join()
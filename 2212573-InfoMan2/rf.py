import os

os.system('cmd /k "firebase emulators:start --export-on-exit=resources \
    --import=resources"')

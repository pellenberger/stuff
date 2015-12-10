import os
import glob

'''
To be executed in a folder (/) containing jpg files.
Deletes all raw files in /raw that are not associated to a jpg file, based on file name.
'''

# get names of jpg files
jpg_files = glob.glob("*.jpg")
jpg_file_names = []
for jpg_file in jpg_files:
    jpg_file_names.append(jpg_file.split(".")[0])

# delete raw file if no jpg file is associated
for raw_file in os.listdir("./raw"):
    if raw_file.split(".")[0] not in jpg_file_names :
        os.remove("./raw/" + raw_file)

print("Done")
        
 

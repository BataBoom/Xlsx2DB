import pandas

excel_data_fragment = pandas.read_excel('/home/bb/xlsx/file.xlsx', sheet_name='Sheet1')

json_str = excel_data_fragment.to_json()

print('Excel Sheet to JSON:\n', json_str)



file = open('file.json', 'w')
file.write(json_str)
file.close()

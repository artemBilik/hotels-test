# hotels-test
# Установка
* git clone git@github.com:artemBilik/hotels-test.git
* cd hotels-test
* docker build -t hotels-test ./
* docker run -it hotels-test /bin/bash
# Запуск
* php src/main.php 'reader' 'command' 'writer'
## Reader
* type(encoder,path)
type - file, db, etc
encoder - csv, xml, json
path - путь к файлу или к бд
### Доступные варианты
file(csv,/app/instance/hotels.csv)

## Command
* command(field,param)
command - order, group
field - name, url, star (поле отеля)
param - direction для order (ask, desc) или функция аггрегации для group (avg, sum, cnt)

### Доступные варианты
group|order(name|url|star,(order(ask|desc)|group(avg,sum,cnt)))

## Writer
* type(encoder,path)
type - file, db, etc
encoder - csv, xml, json
path - путь к файлу или к бд
### Доступные варианты
file(xml|json,/app/instance/order-by-url-desc.csv)


# Пример запуска
* cd /app
* php src/main.php 'file(csv,/app/instance/hotels.csv)' 'group(name,sum)' 'file(json,/app/instance/group-sum-url.json)'

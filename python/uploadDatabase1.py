import openpyxl 
import mysql.connector as mql

conector = mql.connect(
    host="localhost",
    user="root",
    password="root123456",
    database="inventario_db"
)

cursor = conector.cursor()

ruta_excel ='app/database/BASE DATOS PROCESADOS.xlsx'

workbook = openpyxl.load_workbook(ruta_excel)

hoja = workbook['KPI PRE TEST']

rango = hoja['B16':'F90']

# Col 0 : Producto
# Col 1 : Categoria
# Col 2 : Marca
# Col 3 : Presentacion
# Col 4 : Precio

def extraerGrupoPorCol(lista_rango=[], columna=0):
    items = []
    for fila in lista_rango:
        valores = [celda.value for celda in fila]
        if valores[columna] not in items:
            items.append(valores[columna])
    return items

categorias = extraerGrupoPorCol(rango, 1)
marcas = extraerGrupoPorCol(rango, 2)
presentaciones = extraerGrupoPorCol(rango, 3)

# Insertar categorías
for categoria in categorias:
    sql = "INSERT INTO categoria (nombre) VALUES (%s)"
    cursor.execute(sql, (categoria,))

# Insertar marcas

for marca in marcas:
    sql = "INSERT INTO marca (nombre) VALUES (%s)" 
    cursor.execute(sql, (marca,))

# Insertar presentaciones
for presentacion in presentaciones:
    sql = "INSERT INTO presentacion (nombre) VALUES (%s)"
    cursor.execute(sql, (presentacion,))

conector.commit()
cursor.close()
conector.close()

print("Datos ingresados correctamente !")


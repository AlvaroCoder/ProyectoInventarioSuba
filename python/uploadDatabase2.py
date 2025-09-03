import openpyxl 
import mysql.connector as mql

conector = mql.connect(
    host="localhost",
    user="root",
    password="root123456",
    database="inventario_db"
)

cursor = conector.cursor()

def extraeridCategoriaPorNombre(nombreCategoria=""):
    sql = "SELECT idCategoria FROM categoria WHERE nombre=%s"
    cursor.execute(sql, (nombreCategoria,))
    result = cursor.fetchone()
    return result[0] if result else None

def extraeridMarcaPorNombre(nombreMarca=""):
    sql = "SELECT idMarca FROM marca WHERE nombre=%s"
    cursor.execute(sql, (nombreMarca,))
    result = cursor.fetchone()
    return result[0] if result else None

def extraeridPresentacionPorNombre(nombrePresentacion=""):
    sql = "SELECT idPresentacion FROM presentacion WHERE nombre=%s"
    cursor.execute(sql, (nombrePresentacion,))
    result = cursor.fetchone()
    return result[0] if result else None


ruta_excel ='app/database/BASE DATOS PROCESADOS.xlsx'

workbook = openpyxl.load_workbook(ruta_excel)

hoja = workbook['KPI PRE TEST']

rango = hoja['B16':'F90']


for fila in rango:
    valores = [celda.value for celda in fila]
    producto = valores[0]
    categoria = valores[1]
    marca = valores[2]
    presentacion = valores[3]
    precio = valores[4]
    cantidad = 20

    idCategoria = extraeridCategoriaPorNombre(categoria)
    idMarca = extraeridMarcaPorNombre(marca)
    idPresentacion = extraeridPresentacionPorNombre(presentacion)

    sql = """
    INSERT INTO productos (nombre, cantidad, precio, idCategoria, idPresentacion, idMarca)
    VALUES (%s, %s, %s, %s, %s, %s)
    """
    cursor.execute(sql, (producto, cantidad, precio, idCategoria, idPresentacion, idMarca))


conector.commit()
cursor.close()
conector.close()

print("Datos ingresados correctamete !")
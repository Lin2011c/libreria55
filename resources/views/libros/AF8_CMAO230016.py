from random import randint
import random


#ALGORITMO GENERICO BASICO

def crearPoblacion(cant):

    poblacion = []

    #Generar 10 individuos
    for ind in range(cant):

        #Generar ind alearotio de 0 a 31
        individuo=randint(0,31)

        #Codificar a binario
        poblacion.append(format(individuo,f'05b'))
    return poblacion

def evaluarFitness(poblacion):

    fitness =[]

    #Desarrollar funcion objetivo
    for ind in poblacion:

        #Convertir el individuo de binario a decimal
        fit=int(ind,2)**2

        #Meterlo a la lista
        fitness.append(fit)

    return fitness

def Seleccion(poblacion, fitness):

    nuevaPob=[]

    #Seleccionar al primer individuo por elitismo
    mejor = fitness.index(max(fitness))
    nuevaPob.append(poblacion[mejor])

    #Seleccionar 4 por torneo determinista
    for i in range(5):

        ind1=randint(0,9)
        ind2=randint(0,9)

        while(ind1 == ind2):
            ind1=randint(0,9)
            ind2=randint(0,9)

        print("Determinista Ind1=", ind1, "Ind2=", ind2)

        if fitness[ind1] >= fitness[ind2]:
            nuevaPob.append(poblacion[ind1])
        else:
            nuevaPob.append(poblacion[ind2])

    #Seleccionar al resto por torneo probabilista 0.5
    for i in range(5):
        ind1=random.randint(0,9)
        ind2=random.randint(0,9)

        while(ind1==ind2):
            ind1=random.randint(0,9)
            ind1=random.randint(0,9)
        aleatorio=random.random()
        if aleatorio<=0.5:

            if fitness[ind1] >= fitness[ind2]:
                mejor = ind1
                peor = ind2
            else:
                mejor = ind2
                peor = ind1

            print("Probabilista Ind1", ind1, "Ind2", ind2, "aleatorio", aleatorio)

            if aleatorio <= 0.5:
                nuevaPob.append(poblacion[mejor])
            else:
                nuevaPob.append(poblacion[mejor])

def Cruza(poblacion):
    NuevaPob=[]
    while(len(NuevaPob)<10):
        #Seleccionamos a los padres
        padre1 = randint(0,9)
        padre2 = randint(0,9)
        #Evitar que sean los mismos los individuos
        while padre1 == padre2:
            padre1 = randint(0,9)
            padre2 = randint(0,9)
        #Evaluar si se reproducen
        aleatorio = random.random()

        if aleatorio<=0.8:
            #Se reporducen, definir pto. de cruza
            ptoCruza=random.randint(0,4)
            hijo1 = poblacion[padre1][0:ptoCruza] + poblacion[padre2][ptoCruza:]
            hijo2 = poblacion[padre2][0:ptoCruza] + poblacion[padre1][ptoCruza:]
            NuevaPob.append(hijo1)
            NuevaPob.append(hijo2)
        else:
            NuevaPob.append(poblacion[padre1])
            NuevaPob.append(poblacion[padre2])
    return NuevaPob
def ruleta(poblacion,fitness):
    nuevaPob=[]
    #Calcular el fitness total(la aptitud total)
    fitTotal=sum(fitness)
    #Calcular la probabilidad de selección de cada individuo
    probSeleccion=[]
    for fit in fitness:
        probSeleccion.append(fit/fitTotal)
    #Generamos los rangos de selección para cada individuo
    rangoSeleccion=[0]
    for valor in range(10):
        if valor==0:
            rangoSeleccion.append(probSeleccion[valor])
        else:
            rangoSeleccion.append(probSeleccion[valor]+rangoSeleccion[valor-1]) #El valor -1 nos ayuda a regresar al nuemro anterior para ver si hay un valor y sumarlo
    while(len(nuevaPob)<10):
        #Simulamos la seleccion con ruleta
        ruleta=random.random()
        for i in range(10):
            if ruleta<=rangoSeleccion[i]:
                nuevaPob.append(poblacion[i])
                break
    return nuevaPob

def Muta(poblacion):
    nuevaPob = []
    for ind in range(10):
        # generar un aleatorio para evaluar si el individuo muta
        aleatorio = random.random()
        individuo = list(poblacion[ind])
        if aleatorio <= 0.01:
            gen = random.randint(0, 4)
            print("Muto el individuo:", ind, " en gen:", gen)
            
            if individuo[gen] == '0':
                individuo[gen] = '1'
            else:
                individuo[gen] = '0'
        nuevaPob.append(''.join(individuo)) #join cambia la lista por una cadena
    return nuevaPob

#Crear la poblacion aleatoria de 10 individuos
poblacion=crearPoblacion(10)
#Evaluar Fitness
fitness=evaluarFitness(poblacion)
#Criterio de paro por cant. de generaciones
generacion=0

while(generacion<5):
    #Seleccionar a los mejores individuos
    poblacion = ruleta(poblacion,fitness)
    #Reproducimos a los individuos
    poblacion=Cruza(poblacion)
    #Mutar a los individuos
    poblacion=Muta(poblacion)
    #Evaluar las soluciones
    fitness=evaluarFitness(poblacion)
    print(fitness)
    generacion=generacion+1
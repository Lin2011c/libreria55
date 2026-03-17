from random import randint
import random

# Aquí obtenemos nuestra población 
def crearPoblacion(cant):
    poblacion = []
    for ind in range(cant):
        ind1 = randint(-5, 5)
        ind2 = randint(-5, 5)
        ind3 = randint(-5, 5)
        ind4 = randint(-5, 5)

        individuos = [ind1, ind2, ind3, ind4] 
        poblacion.append(individuos)
    return poblacion
#///////////////////////////////////////////////////////////////////////////////////////////////7
# Obtener el fitness de cada valor
def evaluarFitness(poblacion):
    fitness = []

    for ind in poblacion:
        # obtener fit de cada individuo
        fitE1 = -2*(ind[0]) + 3*(ind[1]) - 1*(ind[2]) + 2*(ind[3])
        fitE2 =  3*(ind[0]) - 1*(ind[1]) + 3*(ind[2]) - 1*(ind[3])
        fitE3 = -1*(ind[0]) + 2*(ind[1]) + 5*(ind[2]) - 2*(ind[3])
        fitE4 =  6*(ind[0]) - 3*(ind[1]) + 1*(ind[2]) + 1*(ind[3])
        #sumar diferencias absolutas
        fitFinal = abs(fitE1 - 2) + abs(fitE2 - 2) + abs(fitE3 - 11) + abs(fitE4 + 4)
        fitness.append(fitFinal)
    return fitness

#///////////////////////////////////////////////////////////////////////////////////////////////7
#Por torneo determinista.
def torneoDeterminista(poblacion, fitness):
    nuevaPob=[]
    for i in range(5):
        ind1 = randint(0,9)
        ind2 = randint(0,9)
        while(ind1 == ind2):
            ind1=randint(0,9)
            ind2=randint(0,9)
        print("Determinista Ind1=", ind1, "Ind2=", ind2)

        if fitness[ind1] <= fitness[ind2]:
            nuevaPob.append(poblacion[ind1])
        else:
            nuevaPob.append(poblacion[ind2])
    return nuevaPob
#///////////////////////////////////////////////////////////////////////////////////////////////7
#Obtener seleccion por ruleta
def ruleta(poblacion, fitness):
    nuevaPob = []
    fitInd = []
    for fit in fitness:
        fitInd.append(1/fit)
    
    fitTotal = sum(fitInd)
    # Calcular la probabilidad real basada en fitInd
    probSeleccion = [f/fitTotal for f in fitInd]
    rangoSeleccion = [0]
    for valor in range(len(probSeleccion)): # Usamos len para que sea dinámico
        if valor == 0:
            rangoSeleccion.append(probSeleccion[valor])
        else:
            rangoSeleccion.append(probSeleccion[valor] + rangoSeleccion[valor-1])    
    while(len(nuevaPob) < 5):
        giro = random.random()
        for i in range(len(poblacion)):
            if giro <= rangoSeleccion[i+1]: # i+1 porque rangoSeleccion empieza en 0
                nuevaPob.append(poblacion[i])
                break
    return nuevaPob
#///////////////////////////////////////////////////////////////////////////////////////////////7
#Unimos las dos pobalciones que creamos por ruleta y determinista

   
#///////////////////////////////////////////////////////////////////////////////////////////////7
#Selección aleatoria de parejas de padres, 2 hijos para cada pareja
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
            #Se reproducen, definir pto. de cruza
            ptoCruza=random.randint(0,9)
            hijo1 = poblacion[padre1][0:ptoCruza] + poblacion[padre2][ptoCruza:]
            hijo2 = poblacion[padre2][0:ptoCruza] + poblacion[padre1][ptoCruza:]
            NuevaPob.append(hijo1)
            NuevaPob.append(hijo2)
        else:
            NuevaPob.append(poblacion[padre1])
            NuevaPob.append(poblacion[padre2])
    return NuevaPob

#///////////////////////////////////////////////////////////////////////////////////////////////7
#Muta de un 1 punto con probabilidad de muta del 2.5% (<0.025)
def Muta(poblacion):
    nuevaPob = []
    for ind in range(10):
        # generar un aleatorio para evaluar si el individuo muta
        aleatorio = random.random()
        individuo = list(poblacion[ind])
        if aleatorio <= 0.025:
            gen = random.randint(0, 3)
            print("Muto el individuo:", ind, " en gen:", gen)

            mutarNRan=random.randint(-5,5)
            print("El individuo que muto es", mutarNRan)
            individuo[gen] = mutarNRan
            
    return nuevaPob

#///////////////////////////////////////////////////////////////////////////////////////////////7
#Crear la poblacion aleatoria de 10 individuos
poblacion=crearPoblacion(10)
#Evaluar Fitness
fitness=evaluarFitness(poblacion)
#Criterio de paro por cant. de generaciones
generacion=0

while(generacion<4):
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
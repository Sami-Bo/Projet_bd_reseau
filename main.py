import time

import socketbd

import socket
from _thread import *

import logging

#Configuration de ip
print("Entrer l'ip' : ")
host = input("->")
host = host.encode("utf-8")

# Configuration du port
print("Entrer le port")
port = input("->")
try :
    port = int(port)
except ValueError as e:
    port = 9995  # Port par defaut

ThreadCount = 0



def client_handler(client):
    #client.send(str.encode('You are now connected to the replay server... Type BYE to stop'))
    nombre_essai = 0
    resultat = False
    while True:
        #permet de gérer un client qui met du temps à répondre
        client.settimeout(100)
        try:
            """on met une valeur élevée pour éviter tout risque de dépassement
            même en cas de dépassement le serveur recevra le reste de la requête
            à la prochaine boucle"""
            requete_client = client.recv(2048)
            logging.basicConfig(format='%(asctime)s - %(message)s', level=logging.INFO)
            logging.info("Message reçu du client")
            requete_client = requete_client.decode('utf-8')
            #pour eclipse
            requete_client = requete_client.replace("\r\n", "")
            #pour netcat
            requete_client = requete_client.replace("\n", "")
            requete_client = requete_client.replace("\r", "")
            print(requete_client)
            detection = requete_client.split(" ")
            #on traite le code non prévu
            if not requete_client.isnumeric():
                if detection[0] != "Fin" and requete_client != "BYE":
                    print("code non autorisé, suppression de la requête client")
                    requete_client = "erreur"
            #si la requete du client n'a pas 10 characteres, pas besoin de créer de requetes SQL
            if (detection[0] != "Fin" and len(requete_client) == 10):
                resultat = socketbd.estDansLaBDEtNonFaite(requete_client)
            if (detection[0] == "Fin"):
                id_commande = requete_client.split(":")
                socketbd.setCommande(id_commande[1])
                msg = "c'est fini, deconfigure toi"
                msg += "\r\n"
                client.send(bytes(msg, "utf-8"))
                logging.basicConfig(format='%(asctime)s - %(message)s', level=logging.INFO)
                logging.info("Envoi du message de déconfiguration du client")
                break
            if resultat == True:
                taille = socketbd.getTailleMenu(requete_client)

                i = 0
                timer = 0
                for x in taille:
                    for y in x:
                        if y == "grand":
                            timer += 3
                        elif y == "moyen":
                            timer += 2
                        elif y == "petit":
                            timer += 1

                msg = f"Configure,temps d'attente :{timer}"
                logging.basicConfig(format='%(asctime)s - %(message)s', level=logging.INFO)
                logging.info("Configuration du timer pour le client")
                resultat = False
            else:
                msg = "Non configure, pas de commande correspondant à votre demande (commande déja faite ou non existante)"
            if nombre_essai == 3 or requete_client == 'BYE':  # On perd la connexion
                msg = "Trop d'essai ou demande de fermeture, deconfigure toi"
                msg += "\r\n"
                client.send(bytes(msg, "utf-8"))
                logging.basicConfig(format='%(asctime)s - %(message)s', level=logging.INFO)
                logging.info("Envoi du message d'interruption au client")
                print("CLOSE")
                break
            msg += "\r\n"
            #décommenter cette ligne si vous voulez tester comment est gérer un serveur qui met du temps à répondre
            #time.sleep(10)
            client.send(bytes(msg, "utf-8"))
            logging.basicConfig(format='%(asctime)s - %(message)s', level=logging.INFO)
            logging.info("Envoi d'un message au client")
            nombre_essai += 1
        except (ConnectionResetError, socket.timeout, ConnectionAbortedError, BaseException) as e:
            print(str(e))
            print("Le client a rompu la connexion ou a mis trop de répondre")
            logging.basicConfig(format='%(asctime)s - %(message)s', level=logging.INFO)
            logging.error("Le client a rompu la connexion ou a mis trop de temps à répondre")
            break
    client.close()


def accept_connections(ServerSocket):
    Client, address = ServerSocket.accept()

    print('Connected to: ' + address[0] + ':' + str(address[1]) + '\n')
    logging.basicConfig(format='%(asctime)s - %(message)s', level=logging.INFO)
    logging.info("Connexion du client")
    start_new_thread(client_handler, (Client,))


def start_server(host, port):
    ServerSocket = socket.socket()
    try:
        ServerSocket.bind((host, port))
    except (socket.error, OverflowError) as e:
        print(str(e))
        print("L'ip du serveur ou le numero de port est incorrect ou déjà utilisé")
        logging.basicConfig(format='%(asctime)s - %(message)s', level=logging.INFO)
        logging.error("Mauvais ip ou mauvais port ou port déjà ouvert")
        exit()
    logging.basicConfig(format='%(asctime)s - %(message)s', level=logging.INFO)
    logging.info("Création du socket")
    print(f'Le serveur écoute sur le port {port}...')
    ServerSocket.listen(5)

    while True:
        accept_connections(ServerSocket)


start_server(host, port)

import psycopg2


def connection():
    """ Connect to the PostgreSQL database server """
    conn = None
    try:

        # connect to the PostgreSQL server
        print('Connecting to the PostgreSQL database...')
        conn = psycopg2.connect(
            host="",
            database="",
            user="",
            password="")

        # create a cursor
        cur = conn.cursor()

        # execute a statement
        print('PostgreSQL database version:')
        cur.execute('SELECT version()')

        # display the PostgreSQL database server version
        db_version = cur.fetchone()
        print(db_version)

        # close the communication with the PostgreSQL
        cur.close()
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
    finally:
        if conn is not None:
            conn.close()
            print('Database connection closed.')

def estDansLaBDEtNonFaite(idCommande):
    """ Connect to the PostgreSQL database server """
    conn = None
    present=False
    try:

        # connect to the PostgreSQL server
        print('Connecting to the PostgreSQL database...')
        conn = psycopg2.connect(
            host="",
            database="",
            user="",
            password="")
        print('Bien connecté')
        # create a cursor
        cur = conn.cursor()

        # execute a statement
        requete=f"SELECT * FROM \"Commande\" WHERE id_commande='{idCommande}'AND commande_faite=FALSE;"
        #requete=requete.replace("\r\n","")
        cur.execute(requete)
        result=cur.fetchall()

        if not result:
            print('Il n y a pas de commande correspondant à votre demande ')
        else:
            present=True
            print("Commande Trouvée")
     # close the communication with the PostgreSQL
        cur.close()
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
    finally:
        if conn is not None:
            conn.close()
            print("fermeture\n")
    return present

def getTailleMenu(idCommande):
    """ Connect to the PostgreSQL database server """
    conn = None
    try:
        # connect to the PostgreSQL server
        print('Connecting to the PostgreSQL database...')
        conn = psycopg2.connect(
            host="",
            database="",
            user="",
            password="")
        print('Bien connecté')
        # create a cursor
        cur = conn.cursor()

        # execute a statement
        requete=f"SELECT type_menu FROM \"Menu\" NATURAL JOIN \"Concerne\" WHERE id_commande='{idCommande}';"
        #requete=requete.replace("\r\n","")
        cur.execute(requete)
        result=cur.fetchall()
        return result
        # close the communication with the PostgreSQL
        cur.close()
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
    finally:
        if conn is not None:
            conn.close()
            print("fermeture\n")
    return present

def setCommande(idCommande):
    """ Connect to the PostgreSQL database server """
    conn = None
    try:

        # connect to the PostgreSQL server
        print('Connecting to the PostgreSQL database...')
        conn = psycopg2.connect(
            host="",
            database="",
            user="",
            password="")
        print('Bien connecté')
        # create a cursor
        cur = conn.cursor()

        # execute a statement
        requete=f"UPDATE \"Commande\" SET commande_faite = 'TRUE' WHERE id_commande='{idCommande}';"
        #requete=requete.replace("\r\n","")
        cur.execute(requete)
        conn.commit()
        cur.close()
     # close the communication with the PostgreSQL
        cur.close()
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
    finally:
        if conn is not None:
            conn.close()
            print("La commande à été effectuée")
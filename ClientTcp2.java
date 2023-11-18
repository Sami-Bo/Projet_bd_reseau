package transfertReseau;

import java.io.IOException ;
import java.io.BufferedReader ;
import java.io.InputStreamReader ;
import java.io.PrintWriter ;
import java.net.ConnectException;
import java.net.InetAddress;
import java.net.Socket ;
import java.net.SocketException;
import java.net.SocketTimeoutException;
import java.net.UnknownHostException ;
import java.util.Timer;
import java.util.logging.Level;
import java.util.logging.LogManager;
import java.util.logging.Logger;

public class ClientTcp2 {
	  public static void main (String argv []) throws IOException {
	        Socket socket = null ;
	        PrintWriter flux_sortie = null ;
	        BufferedReader flux_entree = null ;
	        String chaine_entree,chaine_sortie =null ;
	        String decomp_chaine[],decomp_chaine2[];
	        int temps;
	        Timer timer=new Timer(true);
	        int currentLineError = 0;
	        
	        LoggerUtility obj = new LoggerUtility();
	        LogManager lgmngr = LogManager.getLogManager();
	        Logger log = lgmngr.getLogger(Logger.GLOBAL_LOGGER_NAME);
	        
	        try {
	        	int port; // Port par defaut
	            String ip="";
	           
	            BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
	            
	            // Configuration de l'ip
	            System.out.println("Entrer l'adresse ip");
	            ip = br.readLine();
	            System.out.println(ip);
	            
	            // Configuration du port
	            System.out.println("Entrer le port");
	            try {
		            currentLineError = new Throwable().getStackTrace()[0].getLineNumber() +1;
	            	port=Integer.parseInt(br.readLine());
	            }catch(NumberFormatException e) {
	            	port = 9995;
	            }
	            currentLineError = new Throwable().getStackTrace()[0].getLineNumber() +1;
	            socket = new Socket (ip, port) ;
		        log.log(Level.INFO, "Création d'un socket sur l'ip : " +ip+ " et le port : " + port );
	            //socket = new Socket (ip, port) ;
	            flux_sortie = new PrintWriter (socket.getOutputStream (), true) ;
	            flux_entree = new BufferedReader (new InputStreamReader (
	                                        socket.getInputStream ())) ;
	        }
	        catch(IOException | IllegalArgumentException | SecurityException e)
	        {
	        	System.err.println(e);
	            System.err.println("Hote inconnu(Ligne " + currentLineError +")\nVérifier que : \n- Le serveur est lancé\n- Le port est compris entre 0 et 65535\n- Le port indiqué est le même que celui du serveur");
	            System.exit (1) ;
	        }
	        System.out.println ("Entrer l'id d'une commande existante (par exemple : 4869500000) : ");
	        // L'entree standard
	        BufferedReader entree_standard = new BufferedReader ( new InputStreamReader ( System.in)) ;

	    do {
	        boolean b = true;
	        // on lit ce que l'utilisateur a tape sur l'entree standard
	        chaine_entree = entree_standard.readLine () ;
	        //on vérifie que le client entre un entier avant de l'envoyer au serveur
	        if (!chaine_entree.equals("BYE")) {
		        try {
		            Float f = Float.parseFloat(chaine_entree);
		        } catch (NumberFormatException e) {
		            b = false;
		        }
	        }
	        if (b == true) {
		        // et on l'envoie au serveur : id_commande
		        flux_sortie.println (chaine_entree) ;
		        //permet de gérer un temps de réponse trop long
		        socket.setSoTimeout(20000);
		        try {
			        // on lit ce qu'a envoye le serveur
		            currentLineError = new Throwable().getStackTrace()[0].getLineNumber() +1;
			        chaine_sortie = flux_entree.readLine () ;
			        try {
			            currentLineError = new Throwable().getStackTrace()[0].getLineNumber() +1;
			        	chaine_sortie.replace("\r\n", "");
				        log.log(Level.INFO, "Réponse du serveur : " +chaine_sortie );

		            
				        // et on l'affiche a l'ecran
				        System.out.println ("Le serveur m'a repondu :" + chaine_sortie.toString()) ;
			            
				        decomp_chaine = chaine_sortie.split(",");
				        if(decomp_chaine[0].equals("Configure")) {
				        	decomp_chaine2 = chaine_sortie.split(":");
				        	temps=Integer.parseInt(decomp_chaine2[1]);
					        echangeTCP2(temps);
					        flux_sortie.println("Fin de la commande numero :"+chaine_entree);
					        log.log(Level.INFO, "Envoi au serveur : Fin de la commande numero "+chaine_entree );
					        System.out.println ("Temps attendu : " +temps) ;
				            currentLineError = new Throwable().getStackTrace()[0].getLineNumber() +1;
					        chaine_sortie = flux_entree.readLine () ;
				            currentLineError = new Throwable().getStackTrace()[0].getLineNumber() +1;
					        chaine_sortie.replace("\r\n", "");
					        log.log(Level.INFO, "Réponse du serveur : " +chaine_sortie );
					        System.out.println ("Le serveur m'a repondu :" + chaine_sortie) ;
				        }
			        }catch(NullPointerException e) {
			        	 System.err.println("NullPointerException : L'attribut chaine_sortie est " + chaine_sortie + " et ne peut donc pas utiliser replace(Ligne " + currentLineError +")");
			        	 System.err.println("Le serveur a dû couper la connexion");
			        }
		        }catch(SocketTimeoutException | SocketException e) {
		        	 System.err.println("Erreur de socket (Ligne " + currentLineError +")");
		        	 System.err.println("Le serveur a mis trop de temps à répondre ou la connexion a été fermée");
		        	 System.err.println("La communication est interrompue");
			         System.exit (1) ;
		        }
	        }
	        else {
	        	chaine_sortie ="";
	        	System.out.println("Un id ne peut contenir que des entiers, donc veuillez entrer un id correct");
	        }
	    }//while (chaine_sortie != null) ;
	    while(!chaine_sortie.contains("deconfigure"));
	    	System.out.println("je suis sorti !");
	    	flux_sortie.close () ;
	        flux_entree.close () ;
	        entree_standard.close () ;
	        log.log(Level.INFO, "Suppression du socket : " +socket );
	        socket.close () ;

	    }
	  
	  public static void echangeTCP2 (int temps) {
		  temps = temps*1000;
		  try {
			  
			  System.out.println("J'attend "+temps/1000+"secondes");
			  Thread.sleep(temps);
			  
		  }catch(InterruptedException ie) {
			  ie.getMessage();
		  }
	  }
}
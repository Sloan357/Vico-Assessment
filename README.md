# Vico-Assessment

The Repository is a small API challenge which consists of a two step review process.


The Controller logic is built for testing purposes, so the required entites such as:
-

-Client  
-Vico  
-Project  
are manually populated with test data fro the ReviewManager.php

The Review entity has been put in relation with all three previously mentioned entities for the following reason:
-

-in the case of the project, it is a OneToOne relation, and that relation will be used in real life in order to query if a review exists for given project
 in which case it will load the values in the form and in case of any change update via the entityManagerInterface  
 
-a ManyToOne relation with Client and Vico, although the challenge does not require a specific relation, in production, the reviews must be linked to both the Vico and Client
 so to get and average review for the Vico, viewable by the Clients.  

 The Controller logic:  
 -

 -for the first review page, the Controller checks if the Client, Vico and Project Repositories are populated otherwise use the Manager to do so  
 -a form is created based on the ReviewType and passed to the twig along with Vico's name and Projects title  
 -when the form is submitted, it is validated and flushed to the DB and then redirects to the second page review  

 -for the second page, the review is queried in a direct manner, however in reall SAAS it will be taking all the data required from the session login  
 -same as in the first page, the form is rendered based on the OptionalReviewType.php, validated when submitted and flushed
 -the skip button redirects to the success page where the review and optional review are dumped for testing and proof of success, in production ideally it would redirect to the review (viewing) page

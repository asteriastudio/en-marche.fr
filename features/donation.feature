Feature: The goal is to donate one time or multiple time with a subscription
  In order to donate
  As an anonymous user or connected user
  I should be able to donate punctually or subscribe foreach month

  Scenario Outline: The user have to be able to go to donation page every where
    Given the following fixtures are loaded:
      | LoadHomeBlockData |
      | LoadArticleData   |
      | LoadPageData      |
    And I am on "<url>"
    And the response status code should be 200
    Then I should see "Donner"
    When I follow "Donner"
    Then I should be on "/don"
    Examples:
      | url           |
      | /             |
      | /le-mouvement |
      | /evenements   |
      | /comites      |
      | /campus       |
      | /articles     |

  @javascript
  Scenario: An anonyme user can donate successfully
    Given I am on "/don"
    And I press "OK"
    And wait 1 second until I see "Continuer"
    When I press "Continuer"
    Then I should be on "/don/coordonnees?montant=50&abonnement=0"
    When I fill in the following:
      | app_donation_gender        | male                     |
      | Nom                        | Jean                     |
      | Prénom                     | Dupont                   |
      | Adresse email              | jean.dupont@en-marche.fr |
      | Code postal                | 75001                    |
      | Ville                      | Paris                    |
      | Adresse postale            | 1 allée vivaldie         |
      | Numéro de téléphone        | 0123456789               |
    And I click the "donation_check_label" element
    And I click the "donation_check_nationality_label" element
    And I press "Je donne"
    Then I should be on "https://preprod-tpeweb.paybox.com/cgi/MYpagepaiement.cgi"

#  Scenario: The user can subscribe to donate each month successfully

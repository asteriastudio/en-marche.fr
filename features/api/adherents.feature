Feature:
  In order to get adherents' information
  As a referent
  I should be able to acces adherents API data

  Background:
    Given the following fixtures are loaded:
      | LoadUserData      |
      | LoadAdherentData  |

  Scenario: As a non logged-in user I can not access the adherents count information
    When I am on "/api/adherents/count"
    Then the response status code should be 200
    And I should be on "/connexion"

  Scenario: As an adherent I can not access the adherents count information
    When I am logged as "jacques.picard@en-marche.fr"
    And I am on "/api/adherents/count"
    Then the response status code should be 403

  Scenario: As a referent I can access the adherents count information
    When I am logged as "referent@en-marche-dev.fr"
    And I am on "/api/adherents/count"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON should be equal to:
    """
    {
      "female":39,"male":61,"total":18
    }
    """

  Scenario: As a non logged-in user I can not access the managed by referent adherents count information
    When I am on "/api/adherents/count_for_referent_managed_area"
    Then the response status code should be 200
    And I should be on "/connexion"

  Scenario: As an adherent I can not access the managed by referent adherents count information
    When I am logged as "jacques.picard@en-marche.fr"
    And I am on "/api/adherents/count_for_referent_managed_area"
    Then the response status code should be 403

  Scenario: As a referent I can access the managed by referent adherents count information
    When I am logged as "referent@en-marche-dev.fr"
    And I am on "/api/adherents/count_for_referent_managed_area"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON should be equal to:
    """
    {
      "female":22,"male":78,"total":9
    }
    """

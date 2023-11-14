This Lando app uses a Drupal project source that is located outside of the
Lando app root.

This allows tracking the Drupal source code in a separate git repo, instead
of creating a monolith that contains the Lando env code.

This also allows for using the same Lando code for mulitple Drupal projects,
reducing duplicate code and maintenance costs.

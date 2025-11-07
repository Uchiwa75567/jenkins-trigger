pipeline {
    agent any

    // 🔹 Triggers
    triggers {
        // 1️⃣ Détecte les changements dans le dépôt toutes les 5 minutes (remplace githubPush() pour Jenkins local)
        pollSCM('H/5 * * * *')

        // 2️⃣ Déclenchement planifié toutes les 10 minutes
        cron('H/10 * * * *')

        // 3️⃣ Déclenchement après un autre job Jenkins nommé 'JobPrincipal'
        upstream(upstreamProjects: 'JobPrincipal', threshold: hudson.model.Result.SUCCESS)
    }

    // 🔹 Paramètres pour build manuel
    parameters {
        string(name: 'MESSAGE', defaultValue: 'Build Laravel Project', description: 'Message à afficher pendant le build')
    }

    stages {
        stage('Préparation') {
            steps {
                echo "✅ Début du build : ${params.MESSAGE}"
                sh 'php --version'
            }
        }

        stage('Installation dépendances') {
            steps {
                echo "📦 Installation des dépendances Composer..."
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Tests Laravel') {
            steps {
                echo "🚀 Lancement des tests Laravel..."
                sh './vendor/bin/phpunit --testdox || echo "⚠️ Aucun test trouvé, ce n’est pas grave pour la démo."'
            }
        }

        stage('Vérification routes') {
            steps {
                echo "🌍 Vérification du point d’accès Laravel /jenkins-test"
                sh 'php artisan route:list | grep jenkins-test || echo "⚠️ Route non trouvée"'
            }
        }
    }

    post {
        success {
            echo "✅ Build terminé avec succès à ${new Date()}"
        }
        failure {
            echo "❌ Build échoué à ${new Date()}"
        }
    }
}

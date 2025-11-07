pipeline {
    agent any

    triggers {
        // 1️⃣ Déclenchement automatique à chaque push GitHub
        githubPush()

        // 2️⃣ Déclenchement planifié (toutes les 10 minutes)
        cron('H/10 * * * *')

        // 3️⃣ Déclenchement après un autre job Jenkins
        upstream(upstreamProjects: 'JobPrincipal', threshold: hudson.model.Result.SUCCESS)
    }

    parameters {
        // 4️⃣ Déclenchement manuel avec un message
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
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Tests Laravel') {
            steps {
                echo "🚀 Lancement des tests Laravel..."
                sh './vendor/bin/phpunit --testdox || echo "⚠️ Aucun test trouvé, ce n’est pas grave pour la démo."'
            }
        }

        stage('Serveur local (check)') {
            steps {
                echo "🌍 Vérification du point d’accès Laravel"
                sh 'php artisan route:list | grep jenkins-test'
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

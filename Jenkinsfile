pipeline {
    agent any

    environment {
        IMAGE_NAME = 'biblio_app'
        CONTAINER_NAME = 'biblio_container'
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main',
                    url: 'https://github.com/Malal04/biblioShop.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install'
                sh 'npm install && npm run build'
            }
        }

        stage('Run Migrations') {
            steps {
                sh 'php artisan migrate --seed'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t ${IMAGE_NAME} .'
            }
        }

        stage('Run Container') {
            steps {
                sh '''
                docker rm -f ${CONTAINER_NAME} || true
                docker run -d --name ${CONTAINER_NAME} -p 8000:8000 ${IMAGE_NAME}
                '''
            }
        }
    }

    post {
        success {
            echo '🚀 Déploiement terminé avec succès.'
        }
        failure {
            echo '❌ Échec du pipeline.'
        }
    }
}

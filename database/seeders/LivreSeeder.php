<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LivreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $livres = [
            // Catégorie 1 : Roman
            [
                'categorie_id' => 1,
                'titre' => 'L’Étranger',
                'auteur' => 'Albert Camus',
                'prix' => 8000,
                'image' => 'livres/etranger.jpg',
                'description' => 'Un roman emblématique de l’absurde.'
            ],
            [
                'categorie_id' => 1,
                'titre' => 'Le Petit Prince',
                'auteur' => 'Antoine de Saint-Exupéry',
                'prix' => 6000,
                'image' => 'livres/petit_prince.jpg',
                'description' => 'Un conte poétique et philosophique.'
            ],
            [
                'categorie_id' => 1,
                'titre' => 'Notre-Dame de Paris',
                'auteur' => 'Victor Hugo',
                'prix' => 9000,
                'image' => 'livres/notre_dame.jpg',
                'description' => 'Un classique du romantisme.'
            ],
            [
                'categorie_id' => 1,
                'titre' => 'Madame Bovary',
                'auteur' => 'Gustave Flaubert',
                'prix' => 8500,
                'image' => 'livres/madame_bovary.jpg',
                'description' => 'Un chef-d’œuvre du réalisme.'
            ],
            [
                'categorie_id' => 1,
                'titre' => 'Les Misérables',
                'auteur' => 'Victor Hugo',
                'prix' => 10000,
                'image' => 'livres/les_miserables.jpg',
                'description' => 'Une fresque sociale inoubliable.'
            ],

            // Catégorie 2 : Science-Fiction
            [
                'categorie_id' => 2,
                'titre' => 'Dune',
                'auteur' => 'Frank Herbert',
                'prix' => 12000,
                'image' => 'livres/dune.jpg',
                'description' => 'Un monument de la science-fiction.'
            ],
            [
                'categorie_id' => 2,
                'titre' => 'Fondation',
                'auteur' => 'Isaac Asimov',
                'prix' => 9500,
                'image' => 'livres/fondation.jpg',
                'description' => 'Une saga futuriste incontournable.'
            ],
            [
                'categorie_id' => 2,
                'titre' => '1984',
                'auteur' => 'George Orwell',
                'prix' => 8900,
                'image' => 'livres/1984.jpg',
                'description' => 'Un roman dystopique prophétique.'
            ],
            [
                'categorie_id' => 2,
                'titre' => 'La Guerre des Mondes',
                'auteur' => 'H.G. Wells',
                'prix' => 7800,
                'image' => 'livres/guerre_mondes.jpg',
                'description' => 'Une invasion extraterrestre.'
            ],
            [
                'categorie_id' => 2,
                'titre' => 'Neuromancien',
                'auteur' => 'William Gibson',
                'prix' => 8700,
                'image' => 'livres/neuromancien.jpg',
                'description' => 'Le roman fondateur du cyberpunk.'
            ],

            // Catégorie 3 : Biographie
            [
                'categorie_id' => 3,
                'titre' => 'Steve Jobs',
                'auteur' => 'Walter Isaacson',
                'prix' => 15000,
                'image' => 'livres/steve_jobs.jpg',
                'description' => 'La vie du fondateur d’Apple.'
            ],
            [
                'categorie_id' => 3,
                'titre' => 'Une vie',
                'auteur' => 'Simone Veil',
                'prix' => 11000,
                'image' => 'livres/une_vie.jpg',
                'description' => 'Un témoignage fort et inspirant.'
            ],
            [
                'categorie_id' => 3,
                'titre' => 'Long Walk to Freedom',
                'auteur' => 'Nelson Mandela',
                'prix' => 13000,
                'image' => 'livres/mandela.jpg',
                'description' => 'L’autobiographie d’une légende.'
            ],
            [
                'categorie_id' => 3,
                'titre' => 'Lettres à Anne',
                'auteur' => 'François Mitterrand',
                'prix' => 10000,
                'image' => 'livres/lettres_anne.jpg',
                'description' => 'Une correspondance amoureuse.'
            ],
            [
                'categorie_id' => 3,
                'titre' => 'Elon Musk',
                'auteur' => 'Ashlee Vance',
                'prix' => 14000,
                'image' => 'livres/elon_musk.jpg',
                'description' => 'L’homme derrière Tesla et SpaceX.'
            ],

            // Catégorie 4 : Développement personnel
            [
                'categorie_id' => 4,
                'titre' => 'Les 7 habitudes',
                'auteur' => 'Stephen R. Covey',
                'prix' => 9000,
                'image' => 'livres/7_habitudes.jpg',
                'description' => 'Pour une vie plus efficace.'
            ],
            [
                'categorie_id' => 4,
                'titre' => 'Père riche, père pauvre',
                'auteur' => 'Robert Kiyosaki',
                'prix' => 9500,
                'image' => 'livres/pere_riche.jpg',
                'description' => 'Les bases de l’intelligence financière.'
            ],
            [
                'categorie_id' => 4,
                'titre' => 'Pouvoir illimité',
                'auteur' => 'Tony Robbins',
                'prix' => 11000,
                'image' => 'livres/pouvoir_illimite.jpg',
                'description' => 'Déchaîne ton potentiel.'
            ],
            [
                'categorie_id' => 4,
                'titre' => 'Réfléchissez et devenez riche',
                'auteur' => 'Napoleon Hill',
                'prix' => 8700,
                'image' => 'livres/reflechissez.jpg',
                'description' => 'Un classique intemporel.'
            ],
            [
                'categorie_id' => 4,
                'titre' => 'L’art de la méditation',
                'auteur' => 'Matthieu Ricard',
                'prix' => 7800,
                'image' => 'livres/meditation.jpg',
                'description' => 'Vers une paix intérieure.'
            ],

            // Catégorie 5 : Histoire
            [
                'categorie_id' => 5,
                'titre' => 'Sapiens',
                'auteur' => 'Yuval Noah Harari',
                'prix' => 12000,
                'image' => 'livres/sapiens.jpg',
                'description' => 'L’histoire de l’humanité.'
            ],
            [
                'categorie_id' => 5,
                'titre' => 'Les Croisades vues par les Arabes',
                'auteur' => 'Amin Maalouf',
                'prix' => 9800,
                'image' => 'livres/croisades_arabes.jpg',
                'description' => 'Une autre version de l’histoire.'
            ],
            [
                'categorie_id' => 5,
                'titre' => 'L’art de la guerre',
                'auteur' => 'Sun Tzu',
                'prix' => 6000,
                'image' => 'livres/art_guerre.jpg',
                'description' => 'Stratégie et sagesse.'
            ],
            [
                'categorie_id' => 5,
                'titre' => 'Le Moyen Âge pour les nuls',
                'auteur' => 'Jean Verdon',
                'prix' => 8700,
                'image' => 'livres/moyen_age.jpg',
                'description' => 'Une période mal comprise.'
            ],
            [
                'categorie_id' => 5,
                'titre' => 'La Seconde Guerre mondiale',
                'auteur' => 'Antony Beevor',
                'prix' => 13500,
                'image' => 'livres/ww2.jpg',
                'description' => 'Une analyse complète du conflit.'
            ],
        ];

        foreach ($livres as $livre) {
            DB::table('livres')->insert(array_merge($livre, [
                'stock' => rand(5, 20),
                'views' => rand(10, 300),
                'sales_count' => rand(5, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            [
              "name" => "HTML",
              "description" => "Linguaggio di markup per la creazione di pagine web",
              "logo" => "",
            ],
            [
              "name" => "CSS",
              "description" => "Linguaggio per lo stile delle pagine web",
              "logo" => "",
            ],
            [
              "name" => "Bootstrap",
              "description" => "Framework CSS per lo sviluppo di interfacce web responsive",
              "logo" => "",
            ],
            [
              "name" => "Vue.js",
              "description" => "Framework JavaScript progressivo per la creazione di interfacce utente",
              "logo" => "",
            ],
            [
              "name" => "Angular",
              "description" => "Platform per lo sviluppo di applicazioni web",
              "logo" => "",
            ],
            [
              "name" => "JavaScript",
              "description" => "Linguaggio di scripting per il lato client",
              "logo" => "",
            ],
            [
              "name" => "PHP",
              "description" => "Linguaggio di scripting per il lato server",
              "logo" => "",
            ],
            [
              "name" => "Laravel",
              "description" => "Framework PHP per lo sviluppo di applicazioni web",
              "logo" => "",
            ],
            [
              "name" => "Tailwind CSS",
              "description" => "Framework CSS utilizzato per lo sviluppo di interfacce moderne",
              "logo" => "",
            ],
            [
              "name" => "React",
              "description" => "Libreria JavaScript per la creazione di interfacce utente",
              "logo" => "",
            ],
            [
              "name" => "Symfony",
              "description" => "Framework PHP per lo sviluppo di applicazioni web",
              "logo" => "",
            ],
            [
              "name" => "SASS",
              "description" => "Preprocessor CSS con funzionalitÃ  estese",
              "logo" => ""
            ],
            [
              "name" => "Vite",
              "description" => "Bundler JavaScript veloce per lo sviluppo frontend",
              "logo" => "",
            ],
            [
              "name" => "MySQL",
              "description" => "Sistema di gestione di database relazionali",
              "logo" => "",
            ],
            [
              "name" => "Python",
              "description" => "Linguaggio di programmazione ad alto livello e versatile",
              "logo" => "",
            ],
            [
              "name" => "Django",
              "description" => "Framework Python per lo sviluppo di applicazioni web",
              "logo" => "",
            ],
            [
              "name" => "Ruby",
              "description" => "Linguaggio di programmazione dinamico ed elegante",
              "logo" => "",
            ],
            [
              "name" => "Ruby on Rails",
              "description" => "Framework Ruby per lo sviluppo di applicazioni web",
              "logo" => "",
            ],
            [
              "name" => "Java",
              "description" => "Linguaggio di programmazione adatto allo sviluppo di applicazioni aziendali",
              "logo" => "",
            ],
            [
              "name" => "Spring",
              "description" => "Framework Java per lo sviluppo di applicazioni enterprise",
              "logo" => "",
            ],
            [
              "name" => "C#",
              "description" => "Linguaggio di programmazione per lo sviluppo di applicazioni Windows e .NET",
              "logo" => "",
            ],
            [
              "name" => "Tutte le specializzazioni",
              "description" => "",
              "logo" => "",
            ]
        ];

        foreach ($skills as $skill) {

            $newSkill = new Skill();

            $newSkill->name = $skill['name'];
            $newSkill->slug = Str::slug($newSkill->name, '-');
            $newSkill->description = $skill['description'];
            
            $newSkill->save();
        }
    }
}

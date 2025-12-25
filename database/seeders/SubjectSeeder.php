<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            // Profesorado de Educación Primaria (degree_id: 1)
            // 1er año
            ['subject_name' => 'Pedagogía', 'subject_year' => '1', 'degree_id' => 1],
            ['subject_name' => 'Corporeidad, juegos y lenguajes artísticos', 'subject_year' => '1', 'degree_id' => 1],
            ['subject_name' => 'Oralidad, lectura, escritura y TIC', 'subject_year' => '1', 'degree_id' => 1],
            ['subject_name' => 'Didáctica General', 'subject_year' => '1', 'degree_id' => 1],
            ['subject_name' => 'Lengua, literatura y su didáctica I', 'subject_year' => '1', 'degree_id' => 1],
            ['subject_name' => 'Matemática y su didáctica I', 'subject_year' => '1', 'degree_id' => 1],
            ['subject_name' => 'Ciencias sociales y su didáctica I', 'subject_year' => '1', 'degree_id' => 1],
            ['subject_name' => 'Ciencias naturales y tu didáctica I', 'subject_year' => '1', 'degree_id' => 1],
            ['subject_name' => 'Práctica docente I', 'subject_year' => '1', 'degree_id' => 1],
            // 2do año
            ['subject_name' => 'Psicología de educacional', 'subject_year' => '2', 'degree_id' => 1],
            ['subject_name' => 'Historia social, política argentina y latinoamericana', 'subject_year' => '2', 'degree_id' => 1],
            ['subject_name' => 'Filosofía', 'subject_year' => '2', 'degree_id' => 1],
            ['subject_name' => 'Lengua, literatura y su didáctica II', 'subject_year' => '2', 'degree_id' => 1],
            ['subject_name' => 'Matemática y su didáctica II', 'subject_year' => '2', 'degree_id' => 1],
            ['subject_name' => 'Ciencias sociales y su didáctica II', 'subject_year' => '2', 'degree_id' => 1],
            ['subject_name' => 'Ciencias naturales y tu didáctica II', 'subject_year' => '2', 'degree_id' => 1],
            ['subject_name' => 'Sujeto de la educación primaria', 'subject_year' => '2', 'degree_id' => 1],
            ['subject_name' => 'Educación física y su didáctica', 'subject_year' => '2', 'degree_id' => 1],
            ['subject_name' => 'Práctica docente II', 'subject_year' => '2', 'degree_id' => 1],
            // 3er año
            ['subject_name' => 'Sociología de la educación', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'Historia de la educación argentina', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'Derechos humanos: ética y ciudadanía', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'Juegos y producción de materiales', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'Alfabetización en la educación primaria', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'Matemática y su didáctica III', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'TIC y educación primaria', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'Educación tecnológica y su didáctica', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'Lenguajes artísticos I (Cuatrimestral)', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'Lenguajes artísticos II (Cuatrimestral)', 'subject_year' => '3', 'degree_id' => 1],
            ['subject_name' => 'Práctica docente III', 'subject_year' => '3', 'degree_id' => 1],
            // 4to año
            ['subject_name' => 'Análisis y organización de las instituciones educativas', 'subject_year' => '4', 'degree_id' => 1],
            ['subject_name' => 'Educación sexual integral', 'subject_year' => '4', 'degree_id' => 1],
            ['subject_name' => 'Taller interdisciplinario: problemáticas transversales', 'subject_year' => '4', 'degree_id' => 1],
            ['subject_name' => 'Problemáticas contemporáneas en la educación primaria', 'subject_year' => '4', 'degree_id' => 1],
            ['subject_name' => 'Práctica docente IV', 'subject_year' => '4', 'degree_id' => 1],

            // Profesorado de Educación Secundaria en Matemática (degree_id: 2)
            // 1er año
            ['subject_name' => 'Pedagogía', 'subject_year' => '1', 'degree_id' => 2],
            ['subject_name' => 'Corporeidad, juegos y lenguajes artísticos', 'subject_year' => '1', 'degree_id' => 2],
            ['subject_name' => 'Oralidad, lectura, escritura y TIC', 'subject_year' => '1', 'degree_id' => 2],
            ['subject_name' => 'Didáctica General', 'subject_year' => '1', 'degree_id' => 2],
            ['subject_name' => 'Elementos de la Matemática', 'subject_year' => '1', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas de la Geometría I', 'subject_year' => '1', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas del análisis matemático I', 'subject_year' => '1', 'degree_id' => 2],
            ['subject_name' => 'Resolución de problemas y TIC', 'subject_year' => '1', 'degree_id' => 2],
            ['subject_name' => 'Práctica docente I', 'subject_year' => '1', 'degree_id' => 2],
            // 2do año
            ['subject_name' => 'Psicología de educacional', 'subject_year' => '2', 'degree_id' => 2],
            ['subject_name' => 'Historia social, política argentina y latinoamericana', 'subject_year' => '2', 'degree_id' => 2],
            ['subject_name' => 'Filosofía', 'subject_year' => '2', 'degree_id' => 2],
            ['subject_name' => 'Educación sexual integral', 'subject_year' => '2', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas del álgebra I', 'subject_year' => '2', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas de la probabilidad y estadística I', 'subject_year' => '2', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas de la geometría II', 'subject_year' => '2', 'degree_id' => 2],
            ['subject_name' => 'Sujeto de la educación secundaria', 'subject_year' => '2', 'degree_id' => 2],
            ['subject_name' => 'Didáctica de la matemática I', 'subject_year' => '2', 'degree_id' => 2],
            ['subject_name' => 'Práctica docente II', 'subject_year' => '2', 'degree_id' => 2],
            // 3er año
            ['subject_name' => 'Sociología de la educación', 'subject_year' => '3', 'degree_id' => 2],
            ['subject_name' => 'Historia de la educación argentina', 'subject_year' => '3', 'degree_id' => 2],
            ['subject_name' => 'Análisis y organización de las instituciones educativas', 'subject_year' => '3', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas de la probabilidad y estadística II', 'subject_year' => '3', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas de la geometría III', 'subject_year' => '3', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas del análisis matemático II', 'subject_year' => '3', 'degree_id' => 2],
            ['subject_name' => 'Epistemología de la matemática', 'subject_year' => '3', 'degree_id' => 2],
            ['subject_name' => 'Didáctica de la matemática II', 'subject_year' => '3', 'degree_id' => 2],
            ['subject_name' => 'Práctica docente III', 'subject_year' => '3', 'degree_id' => 2],
            // 4to año
            ['subject_name' => 'Derechos humanos: ética y ciudadanía', 'subject_year' => '4', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas del algebra II', 'subject_year' => '4', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas de la geometría IV', 'subject_year' => '4', 'degree_id' => 2],
            ['subject_name' => 'Problemáticas del análisis matemático III', 'subject_year' => '4', 'degree_id' => 2],
            ['subject_name' => 'Modelización matemática de las ciencias', 'subject_year' => '4', 'degree_id' => 2],
            ['subject_name' => 'Práctica docente IV', 'subject_year' => '4', 'degree_id' => 2],

            // Profesorado de Educación Secundaria en Biología (degree_id: 3)
            // 1er año
            ['subject_name' => 'Pedagogía', 'subject_year' => '1', 'degree_id' => 3],
            ['subject_name' => 'Corporeidad, juegos y lenguajes artísticos', 'subject_year' => '1', 'degree_id' => 3],
            ['subject_name' => 'Oralidad, lectura, escritura y TIC', 'subject_year' => '1', 'degree_id' => 3],
            ['subject_name' => 'Didáctica General', 'subject_year' => '1', 'degree_id' => 3],
            ['subject_name' => 'Biología General', 'subject_year' => '1', 'degree_id' => 3],
            ['subject_name' => 'Matemática', 'subject_year' => '1', 'degree_id' => 3],
            ['subject_name' => 'Química', 'subject_year' => '1', 'degree_id' => 3],
            ['subject_name' => 'Física', 'subject_year' => '1', 'degree_id' => 3],
            ['subject_name' => 'Ciencias de la Tierra', 'subject_year' => '1', 'degree_id' => 3],
            ['subject_name' => 'Práctica docente I', 'subject_year' => '1', 'degree_id' => 3],
            // 2do año
            ['subject_name' => 'Psicología de educacional', 'subject_year' => '2', 'degree_id' => 3],
            ['subject_name' => 'Historia social, política argentina y latinoamericana', 'subject_year' => '2', 'degree_id' => 3],
            ['subject_name' => 'Filosofía', 'subject_year' => '2', 'degree_id' => 3],
            ['subject_name' => 'Educación sexual integral', 'subject_year' => '2', 'degree_id' => 3],
            ['subject_name' => 'Biología Celular y Molecular', 'subject_year' => '2', 'degree_id' => 3],
            ['subject_name' => 'Reinos Unicelulares', 'subject_year' => '2', 'degree_id' => 3],
            ['subject_name' => 'Didáctica de las Ciencias Naturales', 'subject_year' => '2', 'degree_id' => 3],
            ['subject_name' => 'Biología Humana', 'subject_year' => '2', 'degree_id' => 3],
            ['subject_name' => 'Sujeto de la Educación Secundaria', 'subject_year' => '2', 'degree_id' => 3],
            ['subject_name' => 'Práctica docente II', 'subject_year' => '2', 'degree_id' => 3],
            // 3er año
            ['subject_name' => 'Sociología de la educación', 'subject_year' => '3', 'degree_id' => 3],
            ['subject_name' => 'Historia de la educación argentina', 'subject_year' => '3', 'degree_id' => 3],
            ['subject_name' => 'Análisis y organización de las instituciones educativas', 'subject_year' => '3', 'degree_id' => 3],
            ['subject_name' => 'Didáctica de la Biología', 'subject_year' => '3', 'degree_id' => 3],
            ['subject_name' => 'Reino Animal', 'subject_year' => '3', 'degree_id' => 3],
            ['subject_name' => 'Epistemología de la Biología', 'subject_year' => '3', 'degree_id' => 3],
            ['subject_name' => 'Reinos Pluricelulares', 'subject_year' => '3', 'degree_id' => 3],
            ['subject_name' => 'UDI', 'subject_year' => '3', 'degree_id' => 3],
            ['subject_name' => 'Práctica docente III', 'subject_year' => '3', 'degree_id' => 3],
            // 4to año
            ['subject_name' => 'Derechos humanos: ética y ciudadanía', 'subject_year' => '4', 'degree_id' => 3],
            ['subject_name' => 'Salud y Ambiente', 'subject_year' => '4', 'degree_id' => 3],
            ['subject_name' => 'Evolución', 'subject_year' => '4', 'degree_id' => 3],
            ['subject_name' => 'Genética', 'subject_year' => '4', 'degree_id' => 3],
            ['subject_name' => 'Ecología', 'subject_year' => '4', 'degree_id' => 3],
            ['subject_name' => 'UDI', 'subject_year' => '4', 'degree_id' => 3],
            ['subject_name' => 'Práctica docente IV', 'subject_year' => '4', 'degree_id' => 3],

            // Profesorado de Educación Secundaria en Lengua y Literatura (degree_id: 4)
            // 2do año
            ['subject_name' => 'Filosofía', 'subject_year' => '2', 'degree_id' => 4],
            ['subject_name' => 'Educación Sexual', 'subject_year' => '2', 'degree_id' => 4],
            ['subject_name' => 'Psicología educacional', 'subject_year' => '2', 'degree_id' => 4],
            ['subject_name' => 'Historia Soc. y Política Argentina y Latinoamericana', 'subject_year' => '2', 'degree_id' => 4],
            ['subject_name' => 'Práctica Docente II', 'subject_year' => '2', 'degree_id' => 4],
            ['subject_name' => 'Sujetos de la Educación Secundaria', 'subject_year' => '2', 'degree_id' => 4],
            ['subject_name' => 'Gramática II', 'subject_year' => '2', 'degree_id' => 4],
            ['subject_name' => 'Lengua y Literatura clásica I (Latín)', 'subject_year' => '2', 'degree_id' => 4],
            ['subject_name' => 'Literatura Universal II', 'subject_year' => '2', 'degree_id' => 4],
            ['subject_name' => 'Didáctica de la Lengua y la Literatura I', 'subject_year' => '2', 'degree_id' => 4],
            // 3er año
            ['subject_name' => 'Historia y Politica de la Educ. Argentina', 'subject_year' => '3', 'degree_id' => 4],
            ['subject_name' => 'Sociologia de la Educacion', 'subject_year' => '3', 'degree_id' => 4],
            ['subject_name' => 'Practica Docente III', 'subject_year' => '3', 'degree_id' => 4],
            ['subject_name' => 'Analisis y Organizacion de las Instituciones Educativas', 'subject_year' => '3', 'degree_id' => 4],
            ['subject_name' => 'Literatura Argentina I', 'subject_year' => '3', 'degree_id' => 4],
            ['subject_name' => 'Lengua y literatura clasica II (Griego)', 'subject_year' => '3', 'degree_id' => 4],
            ['subject_name' => 'Literatura Latinoamericana I', 'subject_year' => '3', 'degree_id' => 4],
            ['subject_name' => 'Epistemologia de la Linguistica', 'subject_year' => '3', 'degree_id' => 4],
            ['subject_name' => 'Didactica de la Lengua y la Literatura II', 'subject_year' => '3', 'degree_id' => 4],
            // 4to año
            ['subject_name' => 'Derechos Humanos, Etica y Ciudadania', 'subject_year' => '4', 'degree_id' => 4],
            ['subject_name' => 'Practica Docente IV', 'subject_year' => '4', 'degree_id' => 4],
            ['subject_name' => 'Alfabetizacion', 'subject_year' => '4', 'degree_id' => 4],
            ['subject_name' => 'Literatura Argentina II', 'subject_year' => '4', 'degree_id' => 4],
            ['subject_name' => 'Historia de la lengua', 'subject_year' => '4', 'degree_id' => 4],
            ['subject_name' => 'Linguistica y Analisis del Discurso', 'subject_year' => '4', 'degree_id' => 4],
            ['subject_name' => 'Literatura Latinoamericana II', 'subject_year' => '4', 'degree_id' => 4],

            // Profesorado de Educación Secundaria en Historia (degree_id: 5)
            // 1er año
            ['subject_name' => 'Pedagogía', 'subject_year' => '1', 'degree_id' => 5],
            ['subject_name' => 'Corporeidad, juegos y lenguajes artísticos', 'subject_year' => '1', 'degree_id' => 5],
            ['subject_name' => 'Oralidad, lectura, escritura y TIC', 'subject_year' => '1', 'degree_id' => 5],
            ['subject_name' => 'Didáctica General', 'subject_year' => '1', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales de la antigüedad', 'subject_year' => '1', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales de los pueblos originarios de américa', 'subject_year' => '1', 'degree_id' => 5],
            ['subject_name' => 'Historia de las ideas I', 'subject_year' => '1', 'degree_id' => 5],
            ['subject_name' => 'Problemática del conocimiento histórico', 'subject_year' => '1', 'degree_id' => 5],
            ['subject_name' => 'Práctica docente I', 'subject_year' => '1', 'degree_id' => 5],
            // 2do año
            ['subject_name' => 'Psicología educacional', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'Filosofía', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'Educación sexual integral', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales del feudalismo y de la modernidad', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales americanos I', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'Historia de las ideas II', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'Economía política', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'El mundo y las nuevas territorialidades', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'Sujeto de la educación secundaria', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'Didáctica de las ciencias sociales', 'subject_year' => '2', 'degree_id' => 5],
            ['subject_name' => 'Práctica docente II', 'subject_year' => '2', 'degree_id' => 5],
            // 3er año
            ['subject_name' => 'Sociología de la educación', 'subject_year' => '3', 'degree_id' => 5],
            ['subject_name' => 'Historia y Política de la educación argentina', 'subject_year' => '3', 'degree_id' => 5],
            ['subject_name' => 'Análisis y organización de las instituciones educativas', 'subject_year' => '3', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales contemporáneos I', 'subject_year' => '3', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales americanos II', 'subject_year' => '3', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales de la argentina I', 'subject_year' => '3', 'degree_id' => 5],
            ['subject_name' => 'Epistemología de la historia', 'subject_year' => '3', 'degree_id' => 5],
            ['subject_name' => 'Didáctica de la historia', 'subject_year' => '3', 'degree_id' => 5],
            ['subject_name' => 'Práctica docente III', 'subject_year' => '3', 'degree_id' => 5],
            // 4to año
            ['subject_name' => 'Derechos humanos: ética y ciudadanía', 'subject_year' => '4', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales contemporáneos II', 'subject_year' => '4', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales americanos III', 'subject_year' => '4', 'degree_id' => 5],
            ['subject_name' => 'Procesos sociales, políticos, económicos y culturales de la argentina II', 'subject_year' => '4', 'degree_id' => 5],
            ['subject_name' => 'Problemáticas históricas regionales y locales', 'subject_year' => '4', 'degree_id' => 5],
            ['subject_name' => 'Práctica docente IV', 'subject_year' => '4', 'degree_id' => 5],

            // Tecnicatura Superior en Análisis y Desarrollo de Software (degree_id: 6)
            // 1er año
            ['subject_name' => 'Problemáticas Sociales, Económicas y Políticas', 'subject_year' => '1', 'degree_id' => 6],
            ['subject_name' => 'Matemática I', 'subject_year' => '1', 'degree_id' => 6],
            ['subject_name' => 'Lógica', 'subject_year' => '1', 'degree_id' => 6],
            ['subject_name' => 'Idioma Extranjero: Inglés Técnico I', 'subject_year' => '1', 'degree_id' => 6],
            ['subject_name' => 'Administración y Gestión I', 'subject_year' => '1', 'degree_id' => 6],
            ['subject_name' => 'Tecnología de la Información', 'subject_year' => '1', 'degree_id' => 6],
            ['subject_name' => 'Programación I', 'subject_year' => '1', 'degree_id' => 6],
            ['subject_name' => 'Base de Datos', 'subject_year' => '1', 'degree_id' => 6],
            ['subject_name' => 'Prácticas Profesionalizantes I', 'subject_year' => '1', 'degree_id' => 6],
            // 2do año
            ['subject_name' => 'Ética Profesional', 'subject_year' => '2', 'degree_id' => 6],
            ['subject_name' => 'Matemática II', 'subject_year' => '2', 'degree_id' => 6],
            ['subject_name' => 'Idioma Extranjero: Inglés Técnico II', 'subject_year' => '2', 'degree_id' => 6],
            ['subject_name' => 'Administración y Gestión II', 'subject_year' => '2', 'degree_id' => 6],
            ['subject_name' => 'Análisis y Diseño de Sistemas I', 'subject_year' => '2', 'degree_id' => 6],
            ['subject_name' => 'Programación II', 'subject_year' => '2', 'degree_id' => 6],
            ['subject_name' => 'Programación de Dispositivos Móviles', 'subject_year' => '2', 'degree_id' => 6],
            ['subject_name' => 'Sistemas operativos y Redes', 'subject_year' => '2', 'degree_id' => 6],
            ['subject_name' => 'Práctica Profesionalizante II', 'subject_year' => '2', 'degree_id' => 6],
            // 3er año
            ['subject_name' => 'Derechos Humanos y ciudadanía', 'subject_year' => '3', 'degree_id' => 6],
            ['subject_name' => 'Probabilidad y estadística', 'subject_year' => '3', 'degree_id' => 6],
            ['subject_name' => 'Legislación Informática', 'subject_year' => '3', 'degree_id' => 6],
            ['subject_name' => 'Análisis y Diseño de Sistemas II', 'subject_year' => '3', 'degree_id' => 6],
            ['subject_name' => 'Programación III', 'subject_year' => '3', 'degree_id' => 6],
            ['subject_name' => 'Auditoría de Sistemas', 'subject_year' => '3', 'degree_id' => 6],
            ['subject_name' => 'Ingeniería de Software', 'subject_year' => '3', 'degree_id' => 6],
            ['subject_name' => 'Práctica Profesionalizante III', 'subject_year' => '3', 'degree_id' => 6],

            // Tecnicatura Superior en Enfermería (degree_id: 7)
            // 1er año
            ['subject_name' => 'Introducción y Fundamentos de los cuidados de Enfermería', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Anatomía y Fisiología', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Bioquímica', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Biofísica', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Bioetica y Deontología', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Metodología de la Investigación I', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Salud Pública', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Farmacología I', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Conocimiento de la Realidad Social en el Contexto Global', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Microbiología y Parasitología', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Primeros Auxilios', 'subject_year' => '1', 'degree_id' => 7],
            ['subject_name' => 'Prácticas Profesionalizantes I', 'subject_year' => '1', 'degree_id' => 7],
            // 2do año
            ['subject_name' => 'Cuidados de Enfermería del Adulto y Anciano', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Enfermería de Salud Mental y Psiquiatría', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Aspectos Psicosociales y Culturales del Desarrollo', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Proceso Social Aplicado en el contexto de Salud', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Metodología de la Investigación II', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Alimentación, Nutrición y Dietoterapia', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Enfermería en Salud Comunitaria', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Farmacología II', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Cuidados integrados basados en la evidencia I', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Idioma extranjero: Inglés Técnico', 'subject_year' => '2', 'degree_id' => 7],
            ['subject_name' => 'Prácticas Profesionalizantes II', 'subject_year' => '2', 'degree_id' => 7],
            // 3er año
            ['subject_name' => 'Enfermería de la madre, niño y adolescentes', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Administración y Gestión de los Recursos en Enfermería', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Comunicación y Educación', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Marcos Legales', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Urgencia y Emergencia', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Informática', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Cuidados Integrados basados en la evidencia II', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Idioma Extranjero: Portugués', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Derechos Humanos', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Seminario de Investigación', 'subject_year' => '3', 'degree_id' => 7],
            ['subject_name' => 'Prácticas Profesionalizantes III', 'subject_year' => '3', 'degree_id' => 7],
        ];

        // Agregar timestamps a todos los registros
        $subjectsWithTimestamps = array_map(function($subject) {
            return array_merge($subject, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }, $subjects);

        Subject::insert($subjectsWithTimestamps);

        $this->command->info('Materias creadas exitosamente!');
    }
}

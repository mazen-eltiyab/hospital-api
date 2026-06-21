<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\File;

class TranslateLargeJson extends Command
{
    protected $signature = 'translate:bulk';
    protected $description = 'ترجمة ملف الكلمات الضخم إلى العربية دفعة واحدة باستخدام الذكاء الاصطناعي';

    public function handle()
    {
        $sourcePath = base_path("lang/en.json");
        $targetPath = base_path("lang/ar.json");

        if (!File::exists($sourcePath)) {
            $this->error("ملف lang/en.json غير موجود. يرجى تشغيل أمر التجميع أولاً!");
            return;
        }

        $sourceData = json_decode(File::get($sourcePath), true);
        $this->info("تم العثور على " . count($sourceData) . " كلمة وجملة في مشروعك.");

        // تقسيم الكلمات لمجموعات لضمان دقة الـ AI وعدم تخطي الـ API limits
        $chunks = array_chunk($sourceData, 30, true);
        $translatedData = [];

        $this->output->progressStart(count($chunks));

        foreach ($chunks as $chunk) {
            $jsonString = json_encode($chunk, JSON_UNESCAPED_UNICODE);

            $prompt = "You are an expert medical system translator. Translate the values of this JSON object into professional Arabic. 
                       Keep the keys exactly as they are in English. Respond ONLY with the raw translated JSON object.";

            try {
                $response = OpenAI::chat()->create([
                    'model' => 'gpt-4o-mini', 
                    'messages' => [
                        ['role' => 'system', 'content' => $prompt],
                        ['role' => 'user', 'content' => $jsonString],
                    ],
                    'temperature' => 0.1,
                ]);

                $chunkResult = json_decode($response->choices[0]->message->content, true);
                if (is_array($chunkResult)) {
                    $translatedData = array_merge($translatedData, $chunkResult);
                }
            } catch (\Exception $e) {
                $this->error("\nخطأ في الترجمة: " . $e->getMessage());
            }

            $this->output->progressAdvance();
        }

        File::put($targetPath, json_encode($translatedData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $this->output->progressFinish();
        $this->info("✨ تم إنشاء ملف lang/ar.json وترجمة كل كلمات المستشفى بنجاح!");
    }
}
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function edit(Configuration $configuration)
    {
        $configuration = Configuration::first();
        //return $configuration;
        return view('admin.configurations.edit', compact('configuration'));
    }


    public function update(Request $request, Configuration $configuration)
    {
        $request->validate([
            'logo'=>'image'
        ]);

         $configuration->update($request->all());


         if($request->hasFile('logo')){

            //$url = Storage::disk('s3')->put('parallaxes', $request->file('image'), 'public');
            $url = request()->file('logo')->store('configurations');

            if($configuration->logo){
                //Storage::disk('s3')->delete($configuration->logo);
                $configuration->update([
                    'logo' => $url
                ]);
            }
        }


        if($request->hasFile('logofooter')){

            //$url = Storage::disk('s3')->put('parallaxes', $request->file('image'), 'public');
            $url = request()->file('logofooter')->store('configurations');

            if($configuration->logofooter){
                //Storage::disk('s3')->delete($configuration->logofooter);
                $configuration->update([
                    'logofooter' => $url
                ]);
            }
        }




        if($request->hasFile('icon')){

            //$url = Storage::disk('s3')->put('parallaxes', $request->file('image'), 'public');
            $url = request()->file('icon')->store('configurations');

            if($configuration->icon){
                //Storage::disk('s3')->delete($configuration->icon);
                $configuration->update([
                    'icon' => $url
                ]);
            }
        }

         $configuration->update();
         //public se refiere a storage/app/public

         //$configuration->update($request->only('name'));
         // return redirect()->route('configurations.edit')->with('flash', 'configuration actualizado con exito');
          return back()->with('flash', 'Configuración actualizado con exito');
    }
}

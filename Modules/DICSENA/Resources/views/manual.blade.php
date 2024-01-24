@extends('dicsena::layouts.master')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="manual">
        <nav>
            @include('dicsena::layouts.partials.navbar')
        </nav>

        <div>
            <h2><a href="">Module DICSENA Manual de Usuario</a></h2>
        </div>

        <div>
            <h3>1. Click on Panel(Nos dirigimos a panel)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/9b1b5a07-80e6-4d74-9eb3-240ae3bd65ef/4150675b-e3eb-46ed-b572-59b4482f8d34.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.9342&fp-y=0.0445&fp-z=2.6574&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=894&mark-y=13&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xOTImaD0xNTEmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Panel" />
        </div>

        <div>
            <h3>2. Click on Subir Guias(Seleccionamos la opcion de subir guias)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/c8cbd460-2d35-4233-8db9-9da5303d8985/83d5467a-dd00-41d3-ad68-cd1ff78f1b7d.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.2705&fp-y=0.3903&fp-z=2.0048&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=361&mark-y=308&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz00NzgmaD0xMzEmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Subir Guias" />
        </div>

        <div>
            <h3>3. Click on Crear Guia(En este boton haremos un nuevo registro)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/2ec2b467-bfb9-4fc5-9fcf-6baee5f699b2/8c902a03-3bc4-457b-861a-e8a33f3d1cde.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.0900&fp-y=0.2337&fp-z=2.4581&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=108&mark-y=306&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0zMTUmaD0xMzQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Crear Guia" />
        </div>

        <div>
            <h3>4. Type "prueba"(Se establece un titulo)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/a0fed1c0-c23e-4f7e-9078-13bdf96650b2/74212c17-2337-4344-a7ff-edc33ff50fc9.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.4916&fp-y=0.4340&fp-z=1.4055&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=253&mark-y=335&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02OTQmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Type &quot;prueba&quot;" />
        </div>

        <div>
            <h3>5. Type "todo surge bien"(Se establece una descripcion)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/97646665-b0b7-4bc5-ad8f-0959a06820eb/6b68f9be-5a15-490e-9591-5a0ee8d48c5d.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.4916&fp-y=0.6089&fp-z=1.4055&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=253&mark-y=295&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02OTQmaD0xNTcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Type &quot;todo surge bien&quot;" />
        </div>

        <div>
            <h3>6. Select CHOCOLATERIA from Program(Eligimos un programa)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/d3a48a67-f69c-4bd9-9dc1-aa492547c8d9/af70fa8b-3758-4e82-8012-8d0101dfae8f.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.4916&fp-y=0.7266&fp-z=1.4055&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=253&mark-y=421&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02OTQmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select CHOCOLATERIA from Program" />
        </div>

        <div>
            <h3>7. Select "Presentación3 - Copia.pdf" from file upload menu(Subimos un archivo formato PDF)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/3c3a264d-9883-47e3-8cac-a061e56cf49f/d3db8a6c-682d-4e04-b4d6-85255311dc72.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.4916&fp-y=0.8569&fp-z=1.4055&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=253&mark-y=565&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02OTQmaD02MyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select &quot;Presentación3 - Copia.pdf&quot; from file upload menu" />
        </div>

        <div>
            <h3>8. Click on Create(Presionamos crear para guardar)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/e4a4ae1d-47db-4649-b425-12fff4a44c83/53f8f14c-492f-4014-9832-2891d6a7098a.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.4916&fp-y=0.9364&fp-z=1.4055&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=253&mark-y=641&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02OTQmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Create" />
        </div>

        <div>
            <h3>9. Click on highlight(Visualizamos el registro en index)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/e12d6737-fdb1-4a85-aade-12c9840ef4f6/c5ef085e-2bcb-42d9-bc32-cd9291040366.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.7834&fp-y=0.7806&fp-z=4.0000&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=553&mark-y=316&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz05NSZoPTExNCZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
        </div>

        <div>
            <h3>10. Click on highlight(Realizaremos una edicion de informacion)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/12ea109f-c312-4740-bb17-0516a112cbff/6c8870a8-3363-4a8d-ae19-1732da7742f5.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.8684&fp-y=0.7862&fp-z=4.0000&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=500&mark-y=281&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xOTkmaD0xODUmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
        </div>

        <div>
            <h3>11. Select ANALISIS Y DESARROLLO DE SOFTWARE from Program(Cambiamos de programa)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/a5f71db2-4e49-4c0a-b99b-28878a56560a/8b5658aa-f9c8-4ab9-bbec-ab3ae3dbb8b5.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.4916&fp-y=0.7266&fp-z=1.4055&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=253&mark-y=421&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02OTQmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select ANALISIS Y DESARROLLO DE SOFTWARE from Program" />
        </div>

        <div>
            <h3>12. Click on Update(Guardamos cambios)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/c242347b-671c-40f9-a5d7-e43a40681686/480b7047-6d39-4cdf-b1d9-ac65b830f6bf.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.4916&fp-y=0.9364&fp-z=1.4055&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=253&mark-y=641&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02OTQmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Update" />
        </div>

        <div>
            <h3>13. Click on highlight(Realizaremos una eliminacion de registro)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/749279c5-5c3a-4179-9ebc-e9ea00cdc961/79c277e0-0852-4db7-a12f-1a3b5c5c74da.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.9179&fp-y=0.7130&fp-z=3.1450&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=819&mark-y=301&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xNDImaD0xNDYmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
        </div>

        <div>
            <h3>14. Submit highlight(Aceptamos eliminacion)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/292c1715-bc29-4cca-a1eb-9f865072f208/1dca3552-3269-4e6b-9773-a8e9e4fbbfd0.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.9179&fp-y=0.7130&fp-z=3.1450&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=819&mark-y=301&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xNDImaD0xNDYmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Submit highlight" />
        </div>
        <h1>Como se crea un glosario nuevo</h1>
        <div>
            <h3>1. Click on Panel(Nos dirigimos a panel nuevamente)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/a58ec4eb-3d3c-4583-825b-f13471d14006/5aaa8da4-dbe9-406f-9172-c91d328676fb.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.1874&fp-y=0.0572&fp-z=2.6574&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=502&mark-y=38&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xOTImaD0xNTEmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Panel" />
        </div>

        <div>
            <h3>2. Click on Agregar Palabras(Seleccionamos la opcion de Agregar Palabras)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/450f0724-742c-42e9-a938-7e0f767f1954/2bda119f-53da-469e-9eb1-763343d77e00.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.7305&fp-y=0.3903&fp-z=2.5810&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=292&mark-y=289&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02MTYmaD0xNjgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Agregar Palabras" />
        </div>

        <div>
            <h3>3. Click on Crear Glosario(Pulsamos el boton de crear)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/b35a5a67-f9d1-4bcf-8e28-c412ca48f0aa/4ed21100-29e6-4cd5-88c2-c1ffe5c16d20.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.1029&fp-y=0.2337&fp-z=2.3119&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=102&mark-y=310&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0zNjgmaD0xMjYmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Crear Glosario" />
        </div>

        <div>
            <h3>4. Type "tirar"(Definimos un titulo)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/8e03721a-5651-47ca-9d79-cf76c0689432/5a3630ff-2e79-446d-8268-80ad859b03f8.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.4340&fp-z=1.4180&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=250&mark-y=335&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03MDAmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Type &quot;tirar&quot;" />
        </div>

        <div>
            <h3>5. Type "arrow"(Establecemos la Traducción)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/ede0e21f-3970-4ff6-936c-87de3e5c5caf/22051b6c-adfc-4f57-a33b-59d4b4470e4d.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.5707&fp-z=1.4180&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=250&mark-y=335&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03MDAmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Type &quot;arrow&quot;" />
        </div>

        <div>
            <h3>6. Type "despojar"(Definimos el significado)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/1ebfc5a3-32e3-468a-841f-819b856351f8/d0960b73-7264-4658-990e-783a35e3b491.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.7075&fp-z=1.4180&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=250&mark-y=398&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03MDAmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Type &quot;despojar&quot;" />
        </div>

        <div>
            <h3>7. Select ANALISIS Y DESARROLLO DE SOFTWARE from Programa:(Seleccionamos el programa que tendra la informacion)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/1bf79337-f559-44b3-bf60-ebe61d9ede72/a3bc163c-b205-4c53-a14e-4b441b740aa7.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.8442&fp-z=1.4180&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=250&mark-y=543&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03MDAmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select ANALISIS Y DESARROLLO DE SOFTWARE from Programa:" />
        </div>

        <div>
            <h3>8. Click on Guardar(Pulsamos guardar para crear el registro)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/c7481b4a-ff3a-44ba-91d9-8b6edebc5923/0470d4bb-9f70-4e5a-bd7a-c8c9d02e6362.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.9300&fp-z=1.4180&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=250&mark-y=634&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03MDAmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Guardar" />
        </div>

        <div>
            <h3>9. Click on highlight(Realizaremos una edicion)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/e36cfb07-1e3b-4d4e-8ca2-9c561fda66ba/ab5da1b4-c87a-4f71-8003-0b033a2b9b98.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.8497&fp-y=0.5318&fp-z=2.7624&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=633&mark-y=309&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMzgmaD0xMjgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
        </div>

        <div>
            <h3>10. Type "delicioso"(Definimos un nuevo valor)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/017c3d32-530a-489e-b365-3a1644c40647/d651de97-dfc6-4977-9661-b6236670d8eb.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.7075&fp-z=1.4180&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=250&mark-y=398&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03MDAmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Type &quot;delicioso&quot;" />
        </div>

        <div>
            <h3>11. Click on Actualizar(Guardamos cambios)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/dd9421a1-181e-4c1a-a9a2-f075eb0c208b/d6f09b6b-abf2-4740-8f3e-5563d118de87.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.9300&fp-z=1.4180&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=250&mark-y=634&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03MDAmaD03NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Actualizar" />
        </div>

        <div>
            <h3>12. Click on delicioso(Se puede observar el cambio realizado)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/7928cf2a-0b37-481d-a909-f3330fe43a68/08550d8d-28b2-4899-949e-79d5ecff0d94.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.3783&fp-y=0.5318&fp-z=2.1681&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=390&mark-y=290&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz00MTkmaD0xNjcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on delicioso" />
        </div>

        <div>
            <h3>13. Click on highlight(Realizaremos la eliminacionde un registro)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/acfeeae1-5990-4e7f-9387-672267d19d25/e622b0de-4d2f-4479-8810-018d25c470a6.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.8991&fp-y=0.7130&fp-z=3.1450&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=748&mark-y=301&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xNDImaD0xNDYmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
        </div>

        <div>
            <h3>14. Submit highlight(Se confirma la eliminacion)</h3>
            <img src="https://images.tango.us/workflows/8543064e-b239-45c8-ac42-f7a0d13fb4d9/steps/dee3536b-af9d-4da0-aaa6-99c4131ca247/02782f6a-64c2-4cd0-9494-84c6687fe68a.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.8991&fp-y=0.7130&fp-z=3.1450&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=748&mark-y=301&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xNDImaD0xNDYmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Submit highlight" />
        </div>


        <div>
            <h2><a>DICSENA Panel de funciones para el aprendiz</a></h2>
        </div>

        <div>
            <h3>Click on highlight(Hay 3 opciones )</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/275c4a2c-2dbe-4945-a1e2-63902933bdb8/8f71f450-18ed-4e65-b06a-9020eb6d0ea1.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.0845&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=34&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9ODgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
        </div>

        <div>
            <h3>1. Click on Traductor(Contiene la vista de traductor)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/7bbd0a7f-d617-4e34-a5c4-41a12ae9282a/e4f1edb9-0092-4023-868a-178984112ae8.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.1612&fp-y=0.2181&fp-z=2.5667&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=358&mark-y=326&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0yNzYmaD0xNTImZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Traductor" />
        </div>

        <div>
            <h3>2. Type "hola"(Escribimos lo que se desea traducir)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/35377bf1-75b1-4056-b2b8-071bf362cee5/56b061e3-8ec0-4296-a73b-51871d044d62.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.3213&fp-y=0.3303&fp-z=1.4361&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=238&mark-y=153&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02MzImaD00NTgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Type &quot;hola&quot;" />
        </div>

        <div>
            <h3>3. Click on Amárico…</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/b8aac717-5791-45cb-9286-c85c2e4ba65f/f4cb438a-9456-40d9-be08-a68a59e98632.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.4501&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=110&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9NTg1JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Amárico…" />
        </div>

        <div>
            <h3>4. Click on Traducir el Texto(Pulsamos el boton de traducir texto)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/32980627-06e9-4af4-8446-a782e922a8a4/ebacb4c7-e5b5-4755-b0d8-507ee1048e08.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.7204&fp-z=1.1601&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=95&mark-y=499&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDA5Jmg9ODkmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Traducir el Texto" />
        </div>

        <div>
            <h3>5. Click on Amárico…(Nos mostrara el resultado)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/6ce7a373-a249-4d7f-9d1d-7f1713703d8c/b28395bf-f0fa-46ef-8ef5-c57135fceec1.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.4501&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=110&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9NTg1JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Amárico…" />
        </div>
        <div>
            <h3>6. Click on highlight(Este boton nos permitira cambiar el idioma a traducir)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/dc4dd4ae-accc-4ce4-a835-346502126bae/3d60be36-0b25-4378-b954-e3dd917de034.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.5730&fp-z=2.9685&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=556&mark-y=358&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz04OCZoPTg4JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
        </div>
        <h1>Como buscar una guia</h1>
        <div>
            <h3>1. Click on highlight(Presionamos el menu de opciones)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/6039e392-b171-4431-8404-b85442dd6431/870374e8-a05c-47d2-ace0-842d9a871705.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.0845&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=34&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9ODgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
        </div>

        <div>
            <h3>2. Click on Guia(Escogemos guia)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/fafac8ee-a85c-4b51-a441-7ff9e64c4896/67c64cc1-ad59-4640-a69c-e2fe12df52a3.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.4912&fp-y=0.2796&fp-z=1.1317&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=91&mark-y=221&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDE4Jmg9NjcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Guia" />
        </div>

        <div>
            <h3>3. Select ACUICULTURA from Selecciona un programa:(Se filtra acuicultura)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/56a62fcd-696e-49ae-b970-484b7b2f0dc1/c732a3f2-60cf-45d5-b35b-d5bc4ff4a43c.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.2535&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=269&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD04NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select ACUICULTURA from Selecciona un programa:" />
        </div>

        <div>
            <h3>4. Click on Filtrar(Al no tener datos no mostrara informacion)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/78822fe2-1cf8-45c1-9c71-370d0ebd7c59/29c41f04-92e8-42b5-9b32-57c3fd1bdd67.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.3794&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=344&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD0xMTcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Filtrar" />
        </div>

        <div>
            <h3>5. Select AGROBIOTECNOLOGÍA from Selecciona un programa:(Elegimos otra opcion)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/bed808ec-781a-4f80-a0e3-c7eb71153ece/97c29451-72f2-474f-83a8-5d1d00f515b5.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.2535&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=269&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD04NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select AGROBIOTECNOLOGÍA from Selecciona un programa:" />
        </div>

        <div>
            <h3>6. Click on Filtrar(Presionamos filtrar)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/5c117fb7-67e1-47c1-a46c-34e85e57cadb/d6c138e7-d667-4860-896b-0b209c8583fa.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.3794&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=344&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD0xMTcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Filtrar" />
        </div>

        <div>
            <h3>7. Click on Título(En una tabla establecemos valores)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/61a536a5-f5d4-4715-a63c-b9211ec7c500/96cee7fb-f865-40b5-945b-c346ed5363c1.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.1766&fp-y=0.4777&fp-z=2.3325&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=314&mark-y=330&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0zNjAmaD0xNDQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Título" />
        </div>

        <div>
            <h3>8. Click on w(Este dato es el titulo)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/98bcf1ed-5d93-4968-8301-c688b89605aa/f6538b7c-a985-4ec7-b771-d83c384a2daa.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.1766&fp-y=0.5407&fp-z=2.3325&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=314&mark-y=330&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0zNjAmaD0xNDQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on w" />
        </div>

        <div>
            <h3>9. Click on Programa(En una tabla establecemos valores)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/d70fddf4-0c72-4a85-ae8d-4c532e275fb0/bd574f29-8a85-494d-a124-1fcda260880f.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.6205&fp-y=0.4777&fp-z=1.7915&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=216&mark-y=347&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03NjgmaD0xMTEmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Programa" />
        </div>

        <div>
            <h3>10. Click on AGROBIOTECNOLOGÍA(Este dato pertenece al nombre del programa)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/ca22c328-1696-4aa6-9364-a021f2bab020/f91ed083-b2d3-4d68-96ea-938e54f5a979.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.6205&fp-y=0.5407&fp-z=1.7915&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=216&mark-y=347&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz03NjgmaD0xMTEmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on AGROBIOTECNOLOGÍA" />
        </div>

        <div>
            <h3>11. Click on   |   (Esto representa el campo de visualizar y descargar archivos)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/540b650d-071d-4728-bda9-355ea041090b/bb996bad-1458-41f3-b92f-06307558549e.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.8718&fp-y=0.5407&fp-z=2.6539&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=534&mark-y=320&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz01MTUmaD0xNjQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on    |   " />
        </div>
        <h1>Como buscar un Glosario</h1>
        <div>
            <h3>1. Click on highlight(Pulsamos menu)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/a43720c8-7313-4d15-9a33-e40fb8c57a89/332af700-e952-4090-9b4f-a76e8580898d.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.0845&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=34&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9ODgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on highlight" />
        </div>

        <div>
            <h3>2. Click on Glosario(Selecionamos glosario)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/abd1725f-219d-4e61-a4ce-4c24502c3e78/676fc026-996e-4dd3-8898-a6bde6baca1d.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5005&fp-y=0.3410&fp-z=1.1437&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=86&mark-y=280&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDI5Jmg9NjgmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Glosario" />
        </div>

        <div>
            <h3>3. Select ANALISIS Y DESARROLLO DE SOFTWARE from Selecciona un programa:(En la barra de busqueda elegimos el programa)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/19d28bf7-ef78-4d72-b646-68a2aaf7e46b/e57d7388-16a2-431e-b937-16bddfb82714.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.2535&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=269&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD04NyZmaXQ9Y3JvcCZjb3JuZXItcmFkaXVzPTEw" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Select ANALISIS Y DESARROLLO DE SOFTWARE from Selecciona un programa:" />
        </div>

        <div>
            <h3>4. Click on Filtrar(Una vez la selecion se pulsa filtrar)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/e1c13a2c-af80-4c62-aeba-a763baf0c1a7/81a938b4-c115-4e89-9266-a8da35f07540.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.5000&fp-y=0.3794&fp-z=1.5308&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=276&mark-y=344&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz02NDkmaD0xMTcmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Filtrar" />
        </div>

        <div>
            <h3>5. Click on Programa(Esta tabla muestra la informacion)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/e33aa2d0-d2d1-46e0-9938-3d8cb657dfe6/c213bf5d-16c5-4379-9eb1-321d47dce34c.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.7147&fp-y=0.4777&fp-z=1.9114&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=54&mark-y=343&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDkxJmg9MTE4JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Programa" />
        </div>

        <div>
            <h3>6. Click on ANALISIS Y DESARROLLO DE SOFTWARE(Este es el nombre del programa)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/71948db2-6cd4-4711-af4e-40f29f9d264a/117ee29f-d61f-4459-90f0-992c1542a55f.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.7147&fp-y=0.5407&fp-z=1.9114&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=54&mark-y=343&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz0xMDkxJmg9MTE4JmZpdD1jcm9wJmNvcm5lci1yYWRpdXM9MTA%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on ANALISIS Y DESARROLLO DE SOFTWARE" />
        </div>

        <div>
            <h3>7. Click on Traducción(Esta tabla muestra la informacion)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/fbdab6b5-2eb8-4749-a40c-3afe601f3dfb/d351ebbb-bc7f-4a8a-856c-72590ef97b86.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.2430&fp-y=0.4777&fp-z=2.1611&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=389&mark-y=335&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz00MjImaD0xMzQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on Traducción" />
        </div>

        <div>
            <h3>8. Click on arrow(Este es el dato de la busqueda)</h3>
            <img src="https://images.tango.us/workflows/e4c28a6e-1e03-45f7-86a2-7b6c336517d0/steps/68f174bd-117f-4989-b04d-cb834b37aad5/99bae532-ac42-4de1-9742-9eb0ba0a99f1.png?fm=png&crop=focalpoint&fit=crop&fp-x=0.2430&fp-y=0.5407&fp-z=2.1611&w=1200&border=2%2CF4F2F7&border-radius=8%2C8%2C8%2C8&border-radius-inner=8%2C8%2C8%2C8&blend-align=bottom&blend-mode=normal&blend-x=0&blend-w=1200&blend64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL21hZGUtd2l0aC10YW5nby13YXRlcm1hcmstdjIucG5n&mark-x=389&mark-y=335&m64=aHR0cHM6Ly9pbWFnZXMudGFuZ28udXMvc3RhdGljL2JsYW5rLnBuZz9tYXNrPWNvcm5lcnMmYm9yZGVyPTQlMkNGRjc0NDImdz00MjImaD0xMzQmZml0PWNyb3AmY29ybmVyLXJhZGl1cz0xMA%3D%3D" style="border-radius: 8px; border: 1px solid #F4F2F7;" width="600" alt="Click on arrow" />
        </div>

        @endsection
package com.kelompok.emajer.Activity.Transaksi.RiwayatTransaksi;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.Manifest;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Bundle;
import android.provider.MediaStore;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.kelompok.emajer.API.APIRequestRiwayatTransaksi;
import com.kelompok.emajer.API.APIUtils;
import com.kelompok.emajer.API.RetrofitClient;
import com.kelompok.emajer.Activity.Transaksi.RiwayatTransaksi.riwayatTransaksi;
import com.kelompok.emajer.Model.RiwayatTransaksi.RiwayatResponse;
import com.kelompok.emajer.Model.RiwayatTransaksi.Upload_gambar;
import com.kelompok.emajer.Model.barang.DataBarangResponse;
import com.kelompok.emajer.R;
import com.squareup.picasso.Picasso;

import java.io.File;

import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;

public class PaymentActivity extends AppCompatActivity {

    private String id_transaksi,total,selectedImage;
    TextView Ptotal;
    ImageView image2, btnBack;
    private CharSequence[] options= {"Camera","Gallery","Cancel"};
    Button pilih, upload;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_payment);

        Intent terima = getIntent();
        id_transaksi = terima.getStringExtra("id_transaksi");
        total = terima.getStringExtra("total");

        Ptotal = findViewById(R.id.pay_tvtotal);
        image2 = findViewById(R.id.pay_image);
        pilih = findViewById(R.id.pay_btnpilihimg);
        upload = findViewById(R.id.pay_btnuploadimg);
        btnBack = findViewById(R.id.pay_btnback);

        Ptotal.setText(total);

        requirePermission();

        pilih.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AlertDialog.Builder builder = new AlertDialog.Builder(PaymentActivity.this);
                builder.setTitle("Select Image");
                builder.setItems(options, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        if(options[which].equals("Camera")){
                            Intent takePic = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                            startActivityForResult(takePic, 0);
                        }
                        else if(options[which].equals("Gallery")) {
                            Intent gallery = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
                            startActivityForResult(gallery, 1);
                        }
                        else {
                            dialog.dismiss();
                        }
                    }
                });
                builder.show();
            }
        });

        upload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                uploadFileToServer();
            }
        });

        btnBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(PaymentActivity.this, riwayatTransaksi.class));
            }
        });
    }

    public void requirePermission(){
        ActivityCompat.requestPermissions(PaymentActivity.this, new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE}, 1);
    }

    public Uri getImageUri(Context context, Bitmap bitmap){
        String path = MediaStore.Images.Media.insertImage(context.getContentResolver(), bitmap, "myImage","");

        return Uri.parse(path);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if(resultCode !=RESULT_CANCELED){

            switch (requestCode){
                case 0:
                    if(resultCode == RESULT_OK && data !=null){
                        Bitmap image = (Bitmap) data.getExtras().get("data");
                        selectedImage = APIUtils.getPath(PaymentActivity.this, getImageUri(PaymentActivity.this,image));
                        image2.setImageBitmap(image);
                    }
                    break;
                case 1:
                    if(resultCode == RESULT_OK && data !=null){

                        Uri image = data.getData();
                        selectedImage = APIUtils.getPath(PaymentActivity.this,image);
                        Picasso.get().load(image).into(image2);
                    }
            }

        }
    }

    public void uploadFileToServer(){

        File file = new File(Uri.parse(selectedImage).getPath());
        RequestBody requestBody = RequestBody.create(MediaType.parse("multipart/form-data"),file);
        MultipartBody.Part filePart = MultipartBody.Part.createFormData("sendimage",file.getName(),requestBody);
        MultipartBody.Part ID = MultipartBody.Part.createFormData("id", id_transaksi);

        APIRequestRiwayatTransaksi service = RetrofitClient.getClient1().create(APIRequestRiwayatTransaksi.class);

        Call<Upload_gambar> call = service.uploadImage(ID, filePart);
        call.enqueue(new Callback<Upload_gambar>()  {
            @Override
            public void onResponse(Call<Upload_gambar> call, Response<Upload_gambar> response) {
                Upload_gambar fileModel = response.body();
                startActivity(new Intent(PaymentActivity.this, riwayatTransaksi.class));
                //Toast.makeText(Payment2.this, fileModel.getMessage(), Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onFailure(Call<Upload_gambar> call, Throwable t) {
                Toast.makeText(PaymentActivity.this, t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });


    }
}
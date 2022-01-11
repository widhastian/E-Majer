package com.kelompok.emajer.Activity.Transaksi.PembayaranKas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.kelompok.emajer.API.APIRequestPembayaranKas;
import com.kelompok.emajer.API.APIUtils;
import com.kelompok.emajer.Model.PembayaranKas.DataMinggu;
import com.kelompok.emajer.Model.PembayaranKas.DataMingguResponse;
import com.kelompok.emajer.Model.PembayaranKas.PilihMinggu;
import com.kelompok.emajer.R;
import com.kelompok.emajer.SessionManager;

import java.io.Serializable;
import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class pembayarankas extends AppCompatActivity {
    private APIRequestPembayaranKas apiRequestPembayaranKas;
    SessionManager SessionManager;
    String id_user;
    Button btnDetailkas;
    ImageView btnback;
    TextView tvTagihan;

    LinearLayout llCheckboxMinggu;
    CheckBox[] ch;

    List<DataMinggu> mingguList = new ArrayList<>();
    List<PilihMinggu> pilihMingguList = new ArrayList<>();
    Integer tagihan = 0;
    //SessionManager.getUserId()
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pembayarankas);
        SessionManager = new SessionManager(this);
        id_user = String.valueOf(SessionManager.getUserId());
        apiRequestPembayaranKas = APIUtils.getReqBayarKas();
        getFindId();
        buildListMinggu();
        setOnClick();
    }

    private void getFindId(){
        btnDetailkas = findViewById(R.id.toDetailKas);
        btnback = findViewById(R.id.btn_backPembayaranKas);
        tvTagihan = findViewById(R.id.tagihanPembayaranKas);
    }

    private void setOnClick(){
        btnDetailkas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (pilihMingguList != null && !pilihMingguList.isEmpty()){
                    Intent i = new Intent(getBaseContext(), detailpembayarankas.class);
                    Bundle args = new Bundle();
                    args.putSerializable("ARRAYLIST",(Serializable)pilihMingguList);
                    i.putExtra("BUNDLE",args);
                    startActivity(i);
                }else{
                    Toast.makeText(getBaseContext(),"Silahkan Pilih Minggu.", Toast.LENGTH_LONG).show();
                }
            }
        });

        btnback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });
    }

    private void setDataMinggu(){
        llCheckboxMinggu = (LinearLayout) findViewById(R.id.checkboxMinggu);

        List<DataMinggu> mList = mingguList;

        ch = new CheckBox[mList.size()];
        for(int i=0; i<mList.size(); i++) {
            tagihan += mList.get(i).getNominal();

            ch[i] = new CheckBox(this);
            String keterangan = mList.get(i).getKeterangan();
            int idMinggu = mList.get(i).getId_minggu();
            ch[i].setId(idMinggu);
            ch[i].setText(keterangan);
            llCheckboxMinggu.addView(ch[i]);
        }
        for (int i = 0; i < mList.size(); i++) {
            final int j = i;
            ch[j].setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
                @Override
                public void onCheckedChanged(CompoundButton buttonView,
                                             boolean isChecked) {
                    int mingguId = ch[j].getId();
                    String keterangan = ch[j].getText().toString();
                    if(buttonView.isChecked()){
                        for(int i = 0; i<mList.size(); i++) {
                            if (mingguId == mList.get(i).getId_minggu()) {
                                int nominal = mList.get(i).getNominal();
                                // menambahkan minggu yang ingin dibayar kedalam array
                                pilihMingguList.add(new PilihMinggu(mingguId,nominal,keterangan));
//                                Toast.makeText(getBaseContext(),pilihMingguList.toString(), Toast.LENGTH_SHORT).show();
                                return;
                            }
                        }
                    }else{
                        // Untuk menghapus array berdasarkan baris, dicek dulu id tiap baris,
                        // kalo ketemu id yg sama, baru di hapus baris array tersebut
                        List<PilihMinggu> pmList = pilihMingguList;
                        for (int i = 0; i < pmList.size(); i++)
                        {
                            int currentId = pmList.get(i).getIdMinggu();
                            if (mingguId == currentId)
                            {
                                pmList.remove(i);
                            }
                        }
//                        Toast.makeText(getBaseContext(),pilihMingguList.toString(), Toast.LENGTH_SHORT).show();
                    }
                }
            });
        }
        tvTagihan.setText(formatRupiah(Double.parseDouble(tagihan.toString())));
    }

    private void buildListMinggu(){
        Call<DataMingguResponse> call = apiRequestPembayaranKas.ambilMinggu(id_user);
        call.enqueue(new Callback<DataMingguResponse>() {
            @Override
            public void onResponse(Call<DataMingguResponse> call, Response<DataMingguResponse> response) {
                if (response.isSuccessful()){
                    String msg = response.body().getMessage();
                    mingguList = response.body().getData();
                    if (mingguList != null && !mingguList.isEmpty()){
                        setDataMinggu();
//                        Toast.makeText(getBaseContext(),"Pesan: "+ msg, Toast.LENGTH_LONG).show();
                    }else{
                        Toast.makeText(getBaseContext(),"Pesan: "+ msg, Toast.LENGTH_LONG).show();
                    }
                } else {
                    Toast.makeText(getBaseContext(),"Gagal ambil data minggu", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<DataMingguResponse> call, Throwable t) {
                Toast.makeText(getBaseContext(),"Gagal konek server ongkir: "+t.getLocalizedMessage(), Toast.LENGTH_LONG).show();
            }
        });
    }

    public String formatRupiah(Double number){
        Locale localeID = new Locale("in", "ID");
        NumberFormat formatRupiah = NumberFormat.getCurrencyInstance(localeID);
        return formatRupiah.format(number);
    }

//    private void buildListMinggu(){
//        mingguList.add(new DataMinggu(1,2000,"Minggu 1 (Des 2021)"));
//        mingguList.add(new DataMinggu(2,2000,"Minggu 2 (Des 2021)"));
//        mingguList.add(new DataMinggu(3,2000,"Minggu 3 (Des 2021)"));
//        setDataMinggu();
//    }
}
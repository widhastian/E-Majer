package com.pina.emajer_v2.Adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.pina.emajer_v2.API.APIRequestMading;
import com.pina.emajer_v2.API.APIUtils;
import com.pina.emajer_v2.Model.Mading.MadingData;
import com.pina.emajer_v2.R;
import com.squareup.picasso.Picasso;

import java.util.List;

public class MadingAdapter extends RecyclerView.Adapter<MadingAdapter.MadingViewHolder> {

    Context context;
    ImageView gbrMading;
    List<MadingData> madingList;
    APIRequestMading apiRequestMading;

    public MadingAdapter(Context context, List<MadingData> madingAdapters){
        this.context = context;
        this.madingList = madingAdapters;
    }
    @NonNull
    @Override
    public MadingViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_list_mading, parent, false);
        apiRequestMading = APIUtils.getReqMading();
        return new MadingViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull MadingViewHolder holder, int position) {
        holder.mdgDeskripsi.setText(madingList.get(position).getDeskripsi_mading());
        holder.tglMading.setText(madingList.get(position).getTgl_pembagian());
        String jenisMading = madingList.get(position).getJenis_mading();
        if (jenisMading.equals("1")) {
            Picasso.get().load("https://ws-tif.com/e-majer/images/mading/pengumuman.png").into(gbrMading);
        } else if (jenisMading.equals("2")) {
            Picasso.get().load("https://ws-tif.com/e-majer/images/mading/informasi.png").into(gbrMading);
        } else if (jenisMading.equals("3")) {
            Picasso.get().load("https://ws-tif.com/e-majer/images/mading/pemberitahuan.png").into(gbrMading);
        }
    }

    @Override
    public int getItemCount() {
        return madingList.size();
    }

    public class MadingViewHolder extends RecyclerView.ViewHolder {
        TextView mdgDeskripsi,tglMading;
        public MadingViewHolder(@NonNull View itemView) {
            super(itemView);
            mdgDeskripsi = itemView.findViewById(R.id.mdg_deskripsi);
            tglMading = itemView.findViewById(R.id.mdg_tanggal);
            gbrMading = itemView.findViewById(R.id.gbr_mading);
        }
    }
}
